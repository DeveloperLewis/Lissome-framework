<?php

namespace classes\validation;

use classes\server\Database;

class GeneralValidation
{
    readonly private array $errors;

    public function emptyInputs(array $inputs): void
    {
        foreach($inputs as $key => $input)
        {
            if (empty($input))
            {
                $this->errors[] = ["Empty input " . $key];
            }
        }
    }

    //Return true if input is greater than the minimum length.
    public function minLength(string $string, int $minLength = 1): void
    {
        if (strlen($string) < $minLength)
        {
            $this->errors[] = ["Text must be greater than $minLength."];
        }
    }

    //Return true if the input is lower than the maximum length.
    public function maxLength(string $string, int $maxLength = 100): void
    {
        if (strlen($string) > $maxLength)
        {
            $this->errors[] = ["Text must be less than $maxLength."];
        }
    }

    public function validateEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = ["This email address is not valid."];
        }
    }

    public function isEmailUnique($email): void
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT email FROM users WHERE email = ?");;

        if (!$stmt->execute([$email])) {
            $this->errors[] = ["Is email unique query did not execute properly."];
            return;
        }

        if (empty($stmt->fetch())) {
            return;
        }
        $this->errors[] = ["Email is not unique"];
    }

    public function LettersAndDigitsOnly($input): void
    {
        if (preg_match('/[^A-Za-z\d]/', $input))
        {
            $this->errors[] = ["Text can only contain letters and digits."];
        }
    }

    public function compareRepeatedPasswords($password, $repeatPassword): void
    {
        if ($password != $repeatPassword)
        {
            $this->errors[] = ["Password does not match"];
        }
    }

    public function passwordRequirements($password): void
    {
        if (preg_match('/[^A-Za-z\d@$!%*?&;:^#]/', $password)) {
            $this->errors[] = ["Password can only contain letters, numbers and @$!%*?&;:&%^# special characters"];
        }

        if (!preg_match('/\d+/', $password)) {
            $this->errors[] = ["Password must contain at least 1 number"];
        }

        if (!preg_match('/[A-Z]+/', $password)) {
            $this->errors[] = ["Password must contain at least 1 uppercase letter"];
        }

        if (!preg_match('/[a-z]+/', $password)) {
            $this->errors[] = ["Password must contain at least 1 lowercase letter"];
        }

        if (!preg_match('/[@$!%*?&;:^#]/', $password)) {
            $this->errors[] = ["Password must contain at least 1 special character: @$!%*?&;:&%^#"];
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}