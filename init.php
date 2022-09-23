<?php
//Create initial Database
$host = "localhost";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
}
catch (PDOException $e) {
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

//Create the user table
try {
    $user_migrations = new \migrations\authentication\UserMigrations();
    $user_migrations->createTable();
} catch (Exception $e) {
    error_log($e);
}
