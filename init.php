<?php

use classes\server\Env;

$env = new Env();
//Create initial Database
$host = $env->server;
$username = $env->username;
$password = $env->password;

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}

//Create Database
try {
    $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS framework");
    if (!$stmt->execute()) {
        throw new \Exception("Failed to create the database.");
    }
} catch (Exception $e) {
    error_log($e);
}

$user_migrations = new \migrations\authentication\UserMigrations();

//Create the user table and alter table
try {
    $user_migrations->createTable();
    $user_migrations->alterPrimaryKey();
    $user_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}
