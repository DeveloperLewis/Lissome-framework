<?php

namespace classes\server;
class Env
{
    //Database Connection Variables
    public string $type     = 'mysql';
    public string $server   = 'localhost';
    public string $db       = 'framework';
    public string $port     = '3306';
    public string $charset  = 'utf8mb4';

    //Database Credentials
    public string $username = 'root';
    public string $password = '';

    //DO NOT INCLUDE THIS ENV.PHP FILE IN ANY PUBLIC REPOSITORIES. THIS COULD COMPROMISE YOUR SECURITY.
}