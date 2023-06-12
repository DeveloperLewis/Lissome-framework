<?php

namespace classes\validation;

use PHPUnit\Framework\TestCase;

class GeneralTest extends TestCase
{
    private General $validator;

    public function setUp(): void
    {
        $this->validator = new General();
    }

    public function testEmptyInputs(): void
    {
        $input1 = null;
        $input2 = "Input2";
        $input3 = "Input3";
        $testInputs = [$input1, $input2, $input3];

        $this->validator->emptyInputs($testInputs);
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testMinLength(): void
    {
        $this->validator->minLength("Hello", 20);
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testMaxLength(): void
    {
        $this->validator->maxLength("Hello", 3);
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testValidateEmail(): void
    {
        $this->validator->validateEmail("Not.a.valid.email");
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testIsEmailUnique(): void
    {
        $this->validator->isEmailUnique("testemail@testinginput.goodtests");
        $errorArray = $this->validator->getErrors();
        $this->assertEmpty($errorArray);
    }

    public function testLettersAndDigitsOnly(): void
    {
        $this->validator->lettersAndDigitsOnly("Special Chars;?!.,");
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testCompareRepeatedPasswords(): void
    {
        $this->validator->compareRepeatedPasswords("Notmatching", "passwords");
        $errorArray = $this->validator->getErrors();
        $result = $errorArray[0];
        $this->assertNotEmpty($result);
    }

    public function testPasswordRequirements(): void
    {
        $this->validator->passwordRequirements("Password1;");
        $errorArray = $this->validator->getErrors();
        $this->assertEmpty($errorArray);
    }

    public function testGetErrors(): void
    {
        $this->assertEmpty($this->validator->getErrors());
    }
}