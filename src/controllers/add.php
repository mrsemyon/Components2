<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$db->create('posts', $_POST);

header('Location:/home');
