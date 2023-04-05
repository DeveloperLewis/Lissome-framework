<?php

namespace classes\server;

use Dotenv\Dotenv;

class Env
{
    //Database Connection Variables
    public string $type;
    public string $server;
    public string $db;
    public string $port;
    public string $charset;

    //Database Credentials
    public string $username;
    public string $password;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $this->type = $_ENV['DBTYPE'];
        $this->server = $_ENV['DBSERVERIP'];
        $this->db = $_ENV['DBNAME'];
        $this->port = $_ENV['DBPORT'];
        $this->charset = $_ENV['DBCHARSET'];

        $this->username = $_ENV['DBUSERNAME'];
        $this->password = $_ENV['DBPASSWORD'];
    }
}