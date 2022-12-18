<?php

namespace App\Controllers;

class HomeController
{
    private $templates;

    public function __construct()
    {
        $this->templates = new \League\Plates\Engine('../App/Views');
    }

    public function index($vars)
    {
        echo $this->templates->render('homepage', ['name' => 'Jonathan']);
    }

    public function about($vars)
    {
        echo $this->templates->render('about', ['name' => 'Jonathan']);
    }
}