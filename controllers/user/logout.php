<?php
use classes\server\Controller;

$controller = new Controller();
$controller->get(function()
{
    unset($_SESSION['user']);
    redirect("/");
});