<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

$templates = new League\Plates\Engine('../src/views');

if (($_SERVER['REDIRECT_URL'] == '/home') || $_SERVER['REDIRECT_URL'] == '/') {
    echo $templates->render('homepage', ['name' => 'Jonathan']);
}
if ($_SERVER['REDIRECT_URL'] == '/about') {
    echo $templates->render('about', ['name' => 'Jonathan']);
}


// if ($_SERVER['REDIRECT_URL'] == '/add') {
//     require '../add.php';
// }
// if ($_SERVER['REDIRECT_URL'] == '/controllers/add') {
//     require '../src/controllers/add.php';
// }

// if ($_SERVER['REDIRECT_URL'] == '/edit') {
//     $_GET[] = $_SERVER["QUERY_STRING"];
//     require '../edit.php';
// }
// if ($_SERVER['REDIRECT_URL'] == '/controllers/edit') {
//     $_GET[] = $_SERVER["QUERY_STRING"];
//     require '../src/controllers/edit.php';
// }

// if ($_SERVER['REDIRECT_URL'] == '/controllers/delete') {
//     $_GET[] = $_SERVER["QUERY_STRING"];
//     require '../src/controllers/delete.php';
// }

exit;
