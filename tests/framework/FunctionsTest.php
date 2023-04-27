<?php

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    function testDateAndTime()
    {
        $timezone = 'Europe/London';
        $timestamp = time();
        $datetime = new DateTime("now", new DateTimeZone($timezone));
        $datetime->setTimestamp($timestamp);

        $expected = $datetime->format('d/m/Y H:i:s');
        $result = dateAndTime();
        $this->assertSame($expected, $result);
    }

    function testIsLoggedIn()
    {
        $result = isLoggedIn();
        $this->assertFalse($result);
    }

    function testUniversalDir()
    {
        $original = "C:/users\john/files/windows\pictures/picture.jpg";
        $result = universalDir($original);
        $this->assertNotSame($original, $result);
    }

    function testShowErrors()
    {
        $empty_array = [];
        $this->assertEmpty(showErrors($empty_array));
    }

    function testShowSuccess()
    {
        $empty_string = "";
        $this->assertEmpty(showSuccess($empty_string));
    }
}