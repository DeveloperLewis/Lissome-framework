<?php

namespace classes\authentication;

class Validator
{
    public string $input;
    private array $errors;

    public function __construct($input)
    {
        $this->input = $input;
    }

    //Return true if input is greater than the minimum length.
    public function minLength(int $minLength = 1): bool
    {
        if ($this->input < $minLength)
        {
            return false;
        }

        $this->errors = ["Text must be greater than $minLength."];
        return true;
    }

    //Return true if the input is lower than the maximum length.
    public function maxLength(int $maxLength = 100): bool
    {
        if (strlen($this->input) > strlen($maxLength))
        {
            return false;
        }

        $this->errors = ["Text must be less than $maxLength."];
        return true;
    }

    public function validateEmail(): bool
    {
        if (!filter_var($this->input, FILTER_VALIDATE_EMAIL)) {
            $this->errors = ["This email address is not valid."];
        }
    }

    public function getErrors(): array
    {
        if (!empty($this->errors))
        {
            return $this->errors;
        }
    }
}