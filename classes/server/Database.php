<?php

namespace classes\server;

use Exception;

class Database
{

    //Database initialization variables
    private string $type = 'mysql';
    private string $server = 'localhost';
    private string $db = 'framework';
    private string $port = '3306';
    private string $charset = 'utf8mb4';

    private string $username = 'root';
    private string $password = '';

    private array $options = [

        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false

    ];

    private $pdo = null;

    //Upon creating a database object, it will connect to the database.
    public function __construct()
    {
        $dsn = "$this->type:host=$this->server;dbname=$this->db;port=$this->port;charset=$this->charset";

        try {
            $this->pdo = new \PDO($dsn, $this->username, $this->password, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    //Here you can get the pdo object from the database object so that you can do database queries, etc...
    public function getPdo()
    {
        return $this->pdo;
    }
}