<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/classes.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';

$db = new QueryBuilder(Connector::make($config['mysql']));