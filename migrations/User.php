<?php

namespace migrations;

use classes\server\Database;
use Exception;

class User
{
    private object $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    //Create the user's table
    public function createTable(): void
    {
        $stmt = $this->pdo->prepare("CREATE TABLE Users (
            user_id int not null,
            username varchar(35) not null,
            email varchar(254) not null,  
            password varchar(150) not null,
            account_creation_date varchar(20) not null
        )");

        if (!$stmt->execute())
        {
            throw new Exception("Failed to create user table.");
        }
    }

    //Set the user_id as the primary key
    public function alterPrimaryKey(): void
    {
        $stmt = $this->pdo->prepare("alter table users
            add constraint users_pk
            primary key (user_id);");

        if (!$stmt->execute())
        {
            throw new Exception("Failed to alter the user table and make the user_id the primary key.");
        }
    }

    //Set the user_id to auto increment
    public function alterAutoIncrement(): string
    {
        $stmt = $this->pdo->prepare("alter table users
            modify user_id int auto_increment;");

        if (!$stmt->execute())
        {
            throw new Exception("Failed to alter the user table and make the user_id auto incrementing");
        }
    }
}