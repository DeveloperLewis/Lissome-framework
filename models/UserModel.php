<?php

namespace classes\models\user;

    class UserModel {

        //Properties of the user
        public $firstName;
        public $email;
        public $password;

        //Creating a new user
        public function __construct($firstName, $email, $password) {  
            $this->firstName = $firstName;
            $this->email = $email;
            $this->password = $password;
        }

        //Return an array containing the user properties
        public function return() {
            $userAttr = [$this->firstName, $this->email, $this->password];
            return $userAttr;
        }

        //Store the user in the database (Make sure to validate before here!)
        public function store() {
            $sql = "INSERT INTO users (firstName, email, password) VALUES (?,?,?)";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->email, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->password, \PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }

        //Return all users from the database
        public static function getAll() {
            $sql = "SELECT * FROM users";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->query($sql);
            $users = $stmt->fetchAll();

            return $users;
        }

    }