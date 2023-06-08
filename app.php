<?php
require_once('vendor/autoload.php');

use classes\server\Router;
use classes\middleware\General;

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
    require_once('views/404.php');
});

//Routing Files
require_once('routes/user.php');
require_once('routes/other.php');

$router->run();
