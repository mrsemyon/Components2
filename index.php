<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$qb = new App\QueryBuilder($db);

$posts = $qb->getAll();

include 'index.view.php';
