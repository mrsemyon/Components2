<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

$db->delete('posts', $_GET['id']);

header('Location:/home');
