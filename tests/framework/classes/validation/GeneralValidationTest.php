<?php

namespace classes\validation;
use PHPUnit\Framework\TestCase;

class GeneralValidationTest extends TestCase
{
    private General $generalValidator;

    private function setValidator(string $testString): void
    {
        $this->generalValidator = new General($testString);
    }
    public function testMinLength(): void
    {
        $this->setValidator("This is a string, greater than the min length.");
        $result = $this->generalValidator->minLength();
        $this->assertTrue($result);
    }

    public function testMaxLength(): void
    {
        $this->setValidator("This is a string, smaller than the max length.");
        $result = $this->generalValidator->maxLength();
        $this->assertTrue($result);
    }

    public function testValidateEmail(): void
    {
        $this->setValidator("n..otValidEMAIL@f");
        $result = $this->generalValidator->validateEmail();
        $this->assertFalse($result);
    }

    public function testGetErrors(): void
    {
        $this->setValidator("n..otValidEMAIL@f");
        $this->generalValidator->validateEmail();
        $this->generalValidator->minLength(50);
        $result = $this->generalValidator->getErrors();
        $this->assertArrayHasKey(1, $result);
    }
}