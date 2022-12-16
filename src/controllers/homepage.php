<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

$posts = $db->getAll();

include $_SERVER['DOCUMENT_ROOT'] . '/../index.view.php';
