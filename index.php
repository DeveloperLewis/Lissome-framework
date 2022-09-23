<?php
require_once('vendor/autoload.php');
$router = new \classes\server\Router();

require_once('init.php');

//Standard & Basic routes
$router->get('/', function () {
    require_once('controllers/index.php');
});

$router->notFound(function () {
    require_once('views/404.php');
});

$router->get('/tests', function () {
    echo $_SERVER['REQUEST_METHOD'];
});

//Routing Files
require_once('routes/user.php');

$router->run();
