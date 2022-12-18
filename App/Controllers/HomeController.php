<?php

namespace App\Controllers;

use App\Classes\Database;

class HomeController
{
    private $templates;

    public function __construct()
    {
        $this->templates = new \League\Plates\Engine('../App/Views');
    }

    public function index($vars)
    {
        $statement = Database::getInstance()->query('SELECT * FROM `posts`');
        $posts = $statement->fetchAll();
        echo $this->templates->render('homepage', ['posts' => $posts]);
    }

    public function about($vars)
    {
        echo $this->templates->render('about', ['name' => 'Jonathan']);
    }
}