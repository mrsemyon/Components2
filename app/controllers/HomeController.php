<?php

namespace App\Controllers;

use App\Classes\QueryBuilder;
use Tamtamchik\SimpleFlash\Flash;
use App\Exceptions\DoesNotExist;

class HomeController
{
    private $templates;

    public function __construct()
    {
        $this->templates = new \League\Plates\Engine('../App/Views');
        $this->db = new QueryBuilder();
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
}
