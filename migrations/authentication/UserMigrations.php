<?php

namespace migrations\authentication;

use classes\server\Database;
use Exception;

class UserMigrations
{

    private object $pdo;


    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }


    /**
     * @throws Exception
     */
    public function createTable(): string
    {
        $stmt = $this->pdo->prepare("CREATE TABLE Users (
            user_id int NOT NULL,
            username varchar(35) NOT NULL,
            email varchar(254) NOT NULL,  
            password varchar(150) NOT NULL,
            account_creation_date varchar(20) NOT NULL
        )");

        if (!$stmt->execute()) {
            throw new Exception("Failed to create user table.");
        }

        return "Successfully created user table.";
    }


    public function alterPrimaryKey(): string
    {
        $stmt = $this->pdo->prepare("ALTER TABLE users
            ADD CONSTRAINT users_pk
            PRIMARY KEY (user_id);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the user table and make the user_id the primary key.");
        }

        return "Successfully altered the primary key.";
    }


    public function alterAutoIncrement(): string
    {
        $stmt = $this->pdo->prepare("ALTER TABLE users
            MODIFY user_id int AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the user table and make the user_id auto incrementing");
        }

        return "Successfully altered the users table.";
    }
}
