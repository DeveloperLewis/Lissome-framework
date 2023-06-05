<?php
namespace classes\validation;
use classes\server\Database;

class General
{
    readonly private array $errors;

    //Validate any empty inputs from array
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

    //Validate a minimum required length
    public function minLength(string $string, int $minLength = 1): void
    {
        if (strlen($string) < $minLength)
        {
            $this->errors[] = ["Text must be greater than $minLength."];
        }
    }

    //Validate a maximum length
    public function maxLength(string $string, int $maxLength = 100): void
    {
        if (strlen($string) > $maxLength)
        {
            $this->errors[] = ["Text must be less than $maxLength."];
        }
    }

    //Verify that the email is a real type of email
    public function validateEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->errors[] = ["This email address is not valid."];
        }
    }

    //Check if the email is unique in the database
    public function isEmailUnique($email): void
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT email FROM users WHERE email = ?");;

        if (!$stmt->execute([$email]))
        {
            $this->errors[] = ["Is email unique query did not execute properly."];
            return;
        }

        if (empty($stmt->fetch()))
        {
            return;
        }
        $this->errors[] = ["Email is not unique"];
    }

    //Validate that only letters and digits may be entered
    public function LettersAndDigitsOnly($input): void
    {
        if (preg_match('/[^A-Za-z\d]/', $input))
        {
            $this->errors[] = ["Text can only contain letters and digits."];
        }
    }

    //Validate that passwords match
    public function compareRepeatedPasswords($password, $repeatPassword): void
    {
        if ($password != $repeatPassword)
        {
            $this->errors[] = ["Password does not match"];
        }
    }

    //Validate the defined parameters that a password requires
    public function passwordRequirements($password): void
    {
        if (preg_match('/[^A-Za-z\d@$!%*?&;:^#]/', $password))
        {
            $this->errors[] = ["Password can only contain letters, numbers and @$!%*?&;:&%^# special characters"];
        }

        if (!preg_match('/\d+/', $password))
        {
            $this->errors[] = ["Password must contain at least 1 number"];
        }

        if (!preg_match('/[A-Z]+/', $password))
        {
            $this->errors[] = ["Password must contain at least 1 uppercase letter"];
        }

        if (!preg_match('/[a-z]+/', $password))
        {
            $this->errors[] = ["Password must contain at least 1 lowercase letter"];
        }

        if (!preg_match('/[@$!%*?&;:^#]/', $password))
        {
            $this->errors[] = ["Password must contain at least 1 special character: @$!%*?&;:&%^#"];
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}