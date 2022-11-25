<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$posts = $db->getAll();

include 'index.view.php';
