<?php
namespace models;

use classes\server\Database;
use Exception;

class User
{
    public int $user_id;
    public string $username;
    public string $email;
    public string $password;
    public string $account_creation_date;

    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function create($username, $email, $password, $account_creation_date): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->account_creation_date = $account_creation_date;
    }

    public function store(): void
    {
        $sql = "INSERT INTO users (username, email, password, account_creation_date) VALUES (?,?,?,?);";
        $stmt = $this->database->getPdo()->prepare($sql);

        if (!$stmt->execute([$this->username, $this->email, $this->password, $this->account_creation_date]))
        {
            throw new Exception("Unable to store user in the database");
        }
    }

    public function authenticate(): void
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->database->getPdo()->prepare($sql);

        if (!$stmt->execute([$this->email]))
        {
            throw new Exception("SQL statement could not be executed");
        }

        if (!$user = $stmt->fetch())
        {
            throw new Exception("User could not be fetched from the database.");
        }

        if (!password_verify($this->password, $user["password"]))
        {
            throw new Exception("Password did not match hashed password in database.");
        }

        $this->user_id = $user["user_id"];
    }

    public function get(int $user_id): void
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->database->getPdo()->prepare($sql);

        if (!$stmt->execute([$user_id]))
        {
            throw new Exception("Failed to execute the get by user_id statement.");
        }

        if (!$user = $stmt->fetch())
        {
            throw new Exception("Failed to fetch the user from the database");
        }

        $this->username = $user["username"];
        $this->email = $user["email"];
        $this->password = $user["password"];
        $this->account_creation_date = $user["account_creation_date"];
        $this->user_id = $user["user_id"];
    }
}