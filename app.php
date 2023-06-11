<?php
require_once('vendor/autoload.php');

use classes\middleware\General;
use classes\server\Router;

$router = new Router();
$middleware = new General();

//Start global session
session_start();

//Standard & Basic routes
$router->get('/', function ()
{
    require_once('controllers/index.php');
});

$router->notFound(function ()
{
    require_once('controllers/404.php');
});

//Routing Files
require_once('routes/user.php');
require_once('routes/other.php');

$router->run();
