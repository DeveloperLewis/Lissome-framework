<?php
$envPath = universalDir(dirname(__DIR__) . "/.env");
if (file_exists($envPath))
{
    echo "A .env file already exists.";
    die();
}

echo "This setup will guide you through setting up your environment variables. \n";
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

if(yesNoLoop("The default database type will be '" . $type . "'. Do you wish to change this? (y/n): "))
{
    $type = readline("Type of database: ");
}

if(yesNoLoop("The server IP is '" . $server . "'. Do you wish to change this? (y/n): "))
{
    $server = readline("Server IP: ");
}

if(yesNoLoop("The default database name will be '" . $db . "'. Do you wish to change this? (y/n): "))
{
    $db = readline("Database name: ");
}

if(yesNoLoop("The default port is '" . $port . "'. Do you wish to change this? (y/n): "))
{
    $port = readline("Port: ");
}

if(yesNoLoop("The default character set is '" . $charset . "'. Do you wish to change this? (y/n): "))
{
    $charset = readline("Character set: ");
}

if(yesNoLoop("The default username login is '" . $username . "' and the password is empty. Would you like to change this? (y/n): "))
{
    $username = readline("Username: ");
    $password = readline("Password: ");
}

$env = fopen($envPath, 'w');
if ($env === false) {
    echo "Failed to create .env file, please ensure you have the correct permissions and try again.";
    die();
}

$envLines = [
    "DBTYPE=" . $type,
    "DBSERVERIP=" . $server,
    "DBNAME=" . $db,
    "DBPORT=" . $port,
    "DBCHARSET=" . $charset,
    "DBUSERNAME=" . $username,
    "DBPASSWORD=" . $password
];

foreach($envLines as $envline)
{
    fwrite($env, $envline . PHP_EOL);
}
fclose($env);
echo "Successfully created your .env file. You can now access it at the root to change anything. \n";
echo "If you wish to run this setup again, please delete the .env file.";






