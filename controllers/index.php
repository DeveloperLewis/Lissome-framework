<?php

use classes\server\Controller;
use models\User;

$controller = new Controller();
$controller->get(function () use ($controller)
{
    $username = null;

    if (isLoggedIn())
    {
        $userModel = new User();
        $userModel->get($_SESSION["user"]["user_id"]);
        $username = $userModel->username;
    }

    echo $controller->twig->render('index.twig', [
        'username' => $username
    ]);
});
