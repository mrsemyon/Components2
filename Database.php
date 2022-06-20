<?php

class Database
{
    private static $instance = null;
    private $pdo;
    private $query;
    private $error = false;
    private $results;
    private $count;

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=dive', 'root', 'root');
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = [])
    {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        $i = 1;
        if (count($params)) {
            foreach ($params as $param) {
                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        try {
            $this->query->execute();
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
        } catch (PDOException $exception) {
            $this->error = $exception->getMessage() . '<br>';
        }
        
        return $this;
    }

    public function error()
    {
        return $this->error;
    }

    public function results()
    {
        return $this->results;
    }

    public function count()
    {
        return $this->count;
    }

}
