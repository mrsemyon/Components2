<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=components;charset=utf8', 'root', 'root');
$statement = $pdo->query('SELECT * FROM `posts`');
$posts = $statement->fetchAll();

include 'index.view.php';
