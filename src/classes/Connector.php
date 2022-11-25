<?php

class Connector
{
    public static function make()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=components;charset=utf8', 'root', 'root');
    }
}
