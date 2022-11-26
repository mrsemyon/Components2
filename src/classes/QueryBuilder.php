<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $statement = $this->pdo->query("SELECT * FROM `posts`");
        return $statement->fetchAll();
    }

    public function create($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $statement = $this->pdo->prepare("INSERT INTO {$table} ({$keys}) VALUES ({$values})");
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }
}
