<?php
require_once('vendor/autoload.php');


$router = new classes\Router();

//Standard & Basic routes
$router->get('/', function() {
    require_once('views/index.php');
});

$router->notFound(function() {
    require_once('views/404.php');
});


//All other routing sets via includes
require_once('routes/user.php');

$router->run();
