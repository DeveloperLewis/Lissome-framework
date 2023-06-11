<?php

use classes\server\Controller;

$controller = new Controller();
$controller->get(function () use ($controller)
{
    unset($_SESSION['user']);
    redirect("/");
});