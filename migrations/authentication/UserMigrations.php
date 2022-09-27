<?php

namespace migrations\authentication;

use classes\server\Database;
use Exception;

class UserMigrations
{
    private object $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    /**
     * @throws Exception
     */
    public function createTable(): string
    {
        $stmt = $this->pdo->prepare("CREATE TABLE Users (
            user_id int not null,
            username varchar(35) not null,
            email varchar(254) not null,  
            password varchar(150) not null,
            account_creation_date varchar(20) not null
        )");

        if (!$stmt->execute()) {
            throw new Exception("Failed to create user table.");
        }
        return "Successfully created user table.";
    }

    public function alterPrimaryKey(): string {
        $stmt = $this->pdo->prepare("alter table users
            add constraint users_pk
            primary key (user_id);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the user table and make the user_id the primary key.");
        }

        return "Successfully altered the primary key.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("alter table users
            modify user_id int auto_increment;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the user table and make the user_id auto incrementing");
        }

        return "Successfully altered the users table.";
    }
}