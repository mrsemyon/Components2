<?php
if( !session_id() ) {
    session_start();
}

include $_SERVER['DOCUMENT_ROOT'] . '/../src/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';



$db = new App\QueryBuilder(App\Connector::make($config['mysql']));
