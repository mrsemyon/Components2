<?php

namespace App\Classes;

use Aura\SqlQuery\QueryFactory;

class QueryBuilder
{
    private $pdo;
    private $queryFactory;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
        $this->queryFactory = new QueryFactory('mysql');
    }

    public function getAll($table)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table);

        $statement = $this->pdo->query($select->getStatement());

        return $statement->fetchAll();
    }

    public function getOne($table, $where)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table)->where($where);

        $statement = $this->pdo->query($select->getStatement());

        return $statement->fetch();
    }

    public function create($table, $data)
    {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)->cols($data);

        $statement = $this->pdo->prepare($insert->getStatement());
        $statement->execute($data);
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

    public function delete($table, $where)
    {
        $whereKey = array_key_first($where);
        $whereKey .= ' = :' . $whereKey;
        
        $delete = $this->queryFactory->newDelete();
        $delete->from($table)->where($whereKey);

        $statement = $this->pdo->prepare($delete);
        $statement->execute($where);
    }
}