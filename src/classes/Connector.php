<?php

namespace App;

class Connector
{
    public static function make($config)
    {
        return new \PDO(
            "mysql:host={$config['host']};dbname={$config['name']};charset={$config['charset']}",
            $config['user'],
            $config['password']
        );
    }
}
