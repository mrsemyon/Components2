<?php

namespace App\Controllers;

use App\Classes\QueryBuilder;
use App\Classes\Database;
use App\Exceptions\DoesNotExist;
use Tamtamchik\SimpleFlash\Flash;
use Delight\Auth\Auth;
use League\Plates\Engine;

class HomeController
{
    private $templates;

    public function __construct()
    {
        $this->templates = new \League\Plates\Engine('../App/Views');
        $this->db = new QueryBuilder();
        $this->auth = new Auth(Database::getInstance());
    }

    public function index($vars)
    {
        echo $this->templates->render('homepage', ['posts' => $this->db->getAll('posts')]);
    }

    public function add($vars)
    {
        if ($_POST) {
            $this->db->create('posts', $_POST);
            header("Location:/home");
            exit;
        } else {
            echo $this->templates->render('add');
        }
    }

    public function show($vars)
    {
        echo $this->templates->render('show', ['post' => $this->db->getOne('posts', "id = {$vars['id']}")]);
    }

    public function delete($vars)
    {
        $this->db->delete('posts', $vars);
        header("Location:/home");
        exit;
    }

    public function edit($vars)
    {
        if ($_POST) {
            $this->db->update('posts', $_POST['id'], $_POST['title']);
            header("Location:/home");
            exit;
        }
        try {
            if (empty($vars)) {
                throw new DoesNotExist("No post selected for editing");
            }
        } catch (DoesNotExist $th) {
            flash()->error($th->getMessage());
            header("Location:/home");
            exit;
        }
        echo $this->templates->render('edit', ['id' => $vars['id']]);
    }

    public function register()
    {
        if (empty($_POST)) {
            echo $this->templates->render('register');
            exit;
        }
        try {
            $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Invalid email address');
            header("Location:/register");
            exit;
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password');
            header("Location:/register");
            exit;
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('User already exists');
            header("Location:/register");
            exit;
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            header("Location:/register");
            exit;
        }
        flash()->success('User successfully register');
        header("Location:/home");
        exit;
    }

    public function login()
    {
        if (empty($_POST)) {
            echo $this->templates->render('login');
            exit;
        }
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Wrong email address');
            header("Location:/login");
            exit;
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Wrong password');
            header("Location:/login");
            exit;
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error('Email not verified');
            header("Location:/login");
            exit;
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            header("Location:/login");
            exit;
        }
        flash()->success('User successfully logged in');
        header("Location:/home");
        exit;
    }

    public function logout()
    {
        try {
            $this->auth->logOutEverywhere();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error('Not logged in');
        }
        header("Location:/home");
        exit;
    }

    public function mail()
    {
        var_dump(\SimpleMail::make()
        ->setTo('sky_net@mail.ru', 'Simon')
        ->setFrom('info@example.com', 'Admin')
        ->setSubject('Тема')
        ->setMessage('Сообщение')
        ->send());
    }
}
