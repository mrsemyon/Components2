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
}