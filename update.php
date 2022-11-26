<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$db->update('posts', $_GET['id'], $_POST['title']);

header('Location:index.php');
