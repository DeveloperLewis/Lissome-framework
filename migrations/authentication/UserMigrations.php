<?php

namespace migrations\authentication;

use classes\server\Database;
use Exception;

class UserMigrations
{
    /**
     * @throws Exception
     */
    public function createTable(): string {
        $database = new Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare("CREATE TABLE Users (
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
}