<?php

use classes\server\Router;

require_once('vendor/autoload.php');
$router = new Router();
$middleware = new classes\middleware\General();

require_once('init.php');

//Start global session
session_start();

//Standard & Basic routes
$router->get('/', function ()
{
    require_once('controllers/index.php');
});

$router->notFound(function ()
{
    require_once('views/404.php');
});

//Routing Files
require_once('routes/user.php');
require_once('routes/other.php');

$router->run();
