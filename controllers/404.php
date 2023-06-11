<?php

use classes\server\Controller;

$controller = new Controller();
$controller->get(function () use ($controller)
{
    echo $controller->twig->render('404.twig');
});
