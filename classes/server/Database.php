<?php
namespace classes\server;
use PDO;
use PDOException;

class Database
{
    private object $pdo;
    private array $options = [
        \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES     => false
    ];

    //Connect to database when object is created
    public function __construct()
    {
        $env = new Env();
        $dsn = "$env->type:host=$env->server;dbname=$env->db;port=$env->port;charset=$env->charset";

        try
        {
            $this->pdo = new PDO($dsn, $env->username, $env->password, $this->options);
        }
        catch (PDOException $e)
        {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}