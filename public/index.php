<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

if ($_SERVER['REQUEST_URI'] == '/home') {
    require '../src/controllers/homepage.php';
}

if ($_SERVER['REQUEST_URI'] == '/add') {
    require '../add.php';
}
if ($_SERVER['REQUEST_URI'] == '/controllers/add') {
    require '../src/controllers/add.php';
}

exit;
