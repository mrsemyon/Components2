<?php

namespace App\Controllers;

use Aura\SqlQuery\QueryFactory;
use App\Classes\QueryBuilder;
use App\Classes\Database;
use App\Exceptions\DoesNotExist;
use Tamtamchik\SimpleFlash\Flash;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Faker\Factory;
use JasonGrimes\Paginator;

class HomeController
{
    private $templates;
    private $qb;
    private $auth;
    private $queryFactory;
    private $pdo;

    public function __construct(
        QueryBuilder $qb,
        Engine $engine,
        Auth $auth,
        QueryFactory $queryFactory,
        \PDO $pdo
    )
    {
        $this->templates = $engine;
        $this->qb = $qb;
        $this->auth = $auth;
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
    }

    public function index()
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from('posts');
        $statement = $this->pdo->prepare($select->getStatement());
        $statement->execute($select->getBindValues());
        $totalItems = $statement->fetchAll();

        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from('posts')
            ->setPaging(5)
            ->page($_GET['page'] ?? 1);
        $statement = $this->pdo->prepare($select->getStatement());
        $statement->execute($select->getBindValues());
        $posts = $statement->fetchAll();

        $itemsPerPage = 5;
        $currentPage = $_GET['page'] ?? 1;
        $urlPattern = '?page=(:num)';

        $paginator = new Paginator(count($totalItems), $itemsPerPage, $currentPage, $urlPattern);

        echo $this->templates->render('homepage', ['posts' => $posts, 'paginator' => $paginator]);
    }

    public function add($vars)
    {
        if ($_POST) {
            $this->qb->create('posts', $_POST);
            header("Location:/home");
            exit;
        } else {
            echo $this->templates->render('add');
        }
    }

    public function show($vars)
    {
        echo $this->templates->render('show', ['post' => $this->qb->getOne('posts', "id = {$vars['id']}")]);
    }

    public function delete($vars)
    {
        $this->qb->delete('posts', $vars);
        header("Location:/home");
        exit;
    }

    public function edit($vars)
    {
        if ($_POST) {
            $this->qb->update('posts', $_POST['id'], $_POST['title']);
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

    public function faker()
    {
        $faker = Factory::create();
        for ($i=0; $i < 10; $i++) { 
            $this->qb->create('posts', ['title' => ucfirst($faker->words(1, true))]);
        }
        header('Location:/home');
        die;
    }
}
