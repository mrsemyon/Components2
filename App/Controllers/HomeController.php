<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\QueryBuilder;

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
}