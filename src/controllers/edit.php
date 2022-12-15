<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

$db->update('posts', $_GET['id'], ['title' => $_POST['title']]);

header('Location:/home');
