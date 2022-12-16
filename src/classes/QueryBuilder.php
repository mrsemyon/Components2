<?php

namespace App;

use Aura\SqlQuery\QueryFactory;

class QueryBuilder
{
    private $pdo;
    private $queryFactory;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->queryFactory = new QueryFactory('mysql');
    }

    public function getAll()
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from('posts');

        $statement = $this->pdo->prepare($select);
        $statement->execute();

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
        $insert = $this->queryFactory->newInsert();

        $insert->into($table)->cols($data);
        $statement = $this->pdo->prepare($insert);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function update($table, $id, $title)
    {
        $update = $this->queryFactory->newUpdate();
        $update
        ->table($table)
        ->cols($title)
        ->where('id = :id')
        ->bindValue('id', $id);

        $statement = $this->pdo->prepare($update->getStatement());
        $statement->execute($update->getBindValues());
    }

    public function delete($table, $id)
    {
        $delete = $this->queryFactory->newDelete();
        $delete->from($table)->where('id = :id');
        $statement = $this->pdo->prepare($delete);
        $statement->execute(['id' => $id]);
    }
}
