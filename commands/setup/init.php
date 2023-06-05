<?php
//Script for creating database
use classes\server\Env;
use migrations\User;

$env        = new Env();
$host       = $env->server;
$username   = $env->username;
$password   = $env->password;

try
{
    $pdo = new PDO("mysql:host=$host", $username, $password);
}
catch (PDOException $e)
{
    die("DB ERROR: " . $e->getMessage());
}

//Create Database
try
{
    $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS $env->db");
    if (!$stmt->execute())
    {
        throw new \Exception("Failed to create the database.");
    }
}
catch (Exception $e)
{
    error_log($e);
    echo "There was an error creating the database, look at apache logs for more information.";
}

//Create User Table
$user_migrations = new User();
try
{
    $user_migrations->createTable();
    $user_migrations->alterPrimaryKey();
    $user_migrations->alterAutoIncrement();
}
catch (Exception $e)
{
    error_log($e);
    echo "There was an error creating the users table, look at apache logs for more information.";
}

echo "Initialization finished.";
