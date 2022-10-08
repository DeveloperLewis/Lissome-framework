<?php

namespace classes\authentication;

use classes\server\Database;
use Exception;

class User
{

    //Checks validations for the username and then sends back an empty array or with errors
    public function validateUsername($username): array
    {
        $username_errors = [];

        if (strlen($username) < 3) {
            $username_errors['min_size'] = "Your name must be greater than 3 character.";
        }

        if (strlen($username) > 30) {
            $username_errors['max_size'] = "Your name must be less than 30 characters.";
        }

        if (preg_match('/[^A-Za-z\d]/', $username)) {
            $username_errors['special_characters'] = "Your name cannot contain any special characters, numbers or spaces.";
        }

        return $username_errors;
    }


    //Checks validations for the email and then sends back an empty array or with errors
    public function validateEmail($email): array
    {
        $email_errors = [];

        if (strlen($email) < 3) {
            $email_errors['min_size'] = "Your email address must be greater than 3 characters.";
        }

        if (strlen($email) > 320) {
            $email_errors['max_size'] = "Your email address must be less than 320 characters.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_errors['invalid'] = "This email address is not valid.";
        }

        try {
            if (!$this->isEmailUnique($email)) {
                $email_errors['unique'] = "Email is already taken.";
            }
        } catch (Exception $e) {
            error_log($e);
            $email_errors['internal'] = "There was an internal error, please try again.";
        }

        return $email_errors;
    }


    //Checks validations for the password and then sends back an empty array or with errors

    public function isEmailUnique($email): bool
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT email FROM users WHERE email = ?");

        if (!$stmt->execute([$email])) {
            throw new Exception("Failed to execute the statement to check if email is unique.");
        }

        if (empty($stmt->fetch())) {
            return true;
        }

        return false;
    }


    //Return whether the email is unique within the database.

    public function validatePassword($password, $repeat_password): array
    {
        $password_errors = [];

        if ($password != $repeat_password) {
            $password_errors['match'] = "Password does not match repeat password";
        }

        if (strlen($_POST['password']) < 8) {
            $password_errors['min_size'] = "Password must be greater than 8 characters";
        }

        if (strlen($_POST['password']) > 128) {
            $password_errors['min_size'] = "Password must be less than 128";
        }

        if (preg_match('/[^A-Za-z\d@$!%*?&;:^#]/', $_POST['password'])) {
            $password_errors['invalid_characters'] = "Password can only contain letters, numbers and @$!%*?&;:&%^# special characters";
        }

        if (!preg_match('/\d+/', $_POST['password'])) {
            $password_errors['number'] = "Password must contain at least 1 number";
        }

        if (!preg_match('/[A-Z]+/', $_POST['password'])) {
            $password_errors['uppercase'] = "Password must contain at least 1 uppercase letter";
        }

        if (!preg_match('/[a-z]+/', $_POST['password'])) {
            $password_errors['lowercase'] = "Password must contain at least 1 lowercase letter";
        }

        if (!preg_match('/[@$!%*?&;:^#]/', $_POST['password'])) {
            $password_errors['special_characters'] = "Password must contain at least 1 special character: @$!%*?&;:&%^#";
        }

        return $password_errors;
    }
}
