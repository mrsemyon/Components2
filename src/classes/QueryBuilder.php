<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function getAll()
    {
        $statement = $this->pdo->query('SELECT * FROM `posts`');
        return $statement->fetchAll();
    }
}
