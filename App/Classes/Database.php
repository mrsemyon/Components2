<?php

namespace App\Classes;

class Database
{
    private static $instance;
    private static $PDO;

    private function __construct()
    {
        $parameters = "mysql:" .
            "host=" . Config::get('mysql.host') . ";" .
            "dbname=" . Config::get('mysql.dbname') . ";" .
            "charset=" . Config::get('mysql.charset');
        self::$PDO = new \PDO(
            $parameters,
            Config::get('mysql.username'),
            Config::get('mysql.password'),
            Config::get('mysql.opt')
        );
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {

            self::$instance = new self;
        }
        return self::$instance::$PDO;
    }
}