<?php

namespace migrations;

use classes\server\Database;
use classes\server\interfaces\Migration;
use Exception;

class User implements Migration
{
    private object $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    public function runMigrations(): void
    {
        $this->createTable();
        $this->alterAutoIncrement();
    }

    //Create the user's table
    private function createTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS Users  (
            user_id int not null,
            username varchar(35) not null,
            email varchar(254) not null,  
            password varchar(150) not null,
            account_creation_date varchar(20) not null,
            PRIMARY KEY (user_id)
        )";

        $stmt = $this->pdo->prepare($sql);

        if (!$stmt->execute())
        {
            throw new Exception("Failed to create user table.");
        }
    }

    //Set the user_id to auto increment
    private function alterAutoIncrement(): void
    {
        $sql = "alter table users
            modify user_id int auto_increment;";


        $stmt = $this->pdo->prepare($sql);

        if (!$stmt->execute())
        {
            throw new Exception("Failed to alter the user table and make the user_id auto incrementing");
        }
    }

}