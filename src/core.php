<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../src/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

$db = App\Connector::make($config['mysql']);
