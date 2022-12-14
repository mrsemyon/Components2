<?php

namespace App;

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

    public function getOne($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }

    public function create($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $statement = $this->pdo->prepare("INSERT INTO {$table} ({$keys}) VALUES ({$values})");
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function update($table, $id, $title)
    {
        $sql = "UPDATE {$table} SET `title` = :title WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(
            [
                'id'    => $id,
                'title' => $title
            ]
        );
    }

    public function delete($table, $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM {$table} WHERE `id` = :id");
        $statement->execute(['id' => $id]);
    }
}
