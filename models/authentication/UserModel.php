<?php

namespace models\authentication;

use classes\server\Database;
use Exception;

class UserModel
{

    public int    $user_id;
    public string $username;
    public string $email;
    public string $password;
    public string $account_creation_date;


    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO users (username, email, password, account_creation_date) VALUES (?,?,?,?);");

        if (!$stmt->execute([$this->username, $this->email, $this->password, $this->account_creation_date])) {
            throw new Exception("Unable to store user in the database");
        }

        return "Successfully stored user in the database";
    }


    public function authenticate(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM users WHERE email = ?");

        if (!$stmt->execute([$this->email])) {
            throw new Exception("SQL statement could not be executed");
        }

        if (!$user = $stmt->fetch()) {
            throw new Exception("User could not be fetched from the database.");
        }

        if (!password_verify($this->password, $user["password"])) {
            throw new Exception("Password did not match hashed password in database.");
        }

        $this->user_id = $user["user_id"];

        return "Successfully authenticated the user and set the user_id property";
    }


    public function get(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM users WHERE user_id = ?");

        if (!$stmt->execute([$this->user_id])) {
            throw new Exception("Failed to execute the get by user_id statement.");
        }

        if (!$user = $stmt->fetch()) {
            throw new Exception("Failed to fetch the user from the database");
        }

        $this->create($user["username"], $user["email"], $user["password"], $user["account_creation_date"], $user["user_id"]);

        return "Successfully created the userModel and filled properties.";
    }


    public function create($username, $email, $password, $account_creation_date, $user_id = 0): void
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->account_creation_date = $account_creation_date;
    }
}
