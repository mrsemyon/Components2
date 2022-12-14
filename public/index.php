<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

if ($_SERVER['REQUEST_URI'] == '/home') {
    require '../src/controllers/homepage.php';
}

exit;
