<?php
$controller = new \classes\server\Controller();
$controller->get(function()
{
    unset($_SESSION['user']);
    redirect("/");
});