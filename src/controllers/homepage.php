<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../src/core.php';

use Aura\SqlQuery\QueryFactory;

$queryFactory = new QueryFactory('mysql');
$select = $queryFactory->newSelect();
$select->cols(['*'])->from('posts');

$statement = $db->prepare($select);
$statement->execute();
$posts = $statement->fetchAll();

include $_SERVER['DOCUMENT_ROOT'] . '/../index.view.php';