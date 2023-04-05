<?php
if (file_exists(universalDir(dirname(__DIR__) . "/.env")))
{
    echo "A .env file already exists.";
    die();
}
echo "This setup will guide you through setting up your environment variables. \n";
echo "Alternatively, you can just edit /classes/server/Env.php \n";

if(!yesNoLoop("Do you wish to continue? (y/n): "))
{
    die();
}

$type     = 'mysql';
$server   = 'localhost';
$db       = 'framework';
$port     = '3306';
$charset  = 'utf8mb4';
$username = 'root';
$password = '';

if(yesNoLoop("The type of database is '" . $type . ". Do you wish to change this? (y/n): "))
{
    $type = readline("Database Type: ");
}

echo "done";
echo $type;





