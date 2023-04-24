<?php

namespace classes\validation;

class GeneralValidation
{
    public string $input;
    private array $errors;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    //Return true if input is greater than the minimum length.
    public function minLength(int $minLength = 1): bool
    {
        if (strlen($this->input) < $minLength)
        {
            $this->errors[] = ["Text must be greater than $minLength."];
            return false;
        }
        return true;
    }

    //Return true if the input is lower than the maximum length.
    public function maxLength(int $maxLength = 100): bool
    {
        if (strlen($this->input) > $maxLength)
        {
            $this->errors[] = ["Text must be less than $maxLength."];
            return false;
        }
        return true;
    }

    public function validateEmail(): bool
    {
        if (!filter_var($this->input, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = ["This email address is not valid."];
            return false;
        }
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}