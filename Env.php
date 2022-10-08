<?php

class Env
{
    //Database variables
    public string $type    = 'mysql';
    public string $server  = 'localhost';
    public string $db      = 'framework';
    public string $port    = '3306';
    public string $charset = 'utf8mb4';

    public string $username = 'root';
    public string $password = '';

    //Mailer Variables;
    public string $host          = '';
    public bool $SMTPAuth        = true;
    public string $mail_username = 'YOUR USERNAME';
    public string $mail_password = 'YOUR PASSWORD';
    public int $mail_port        = 465;
    public string $mailer = "FROMYOUR@EMAIL.COM";
}