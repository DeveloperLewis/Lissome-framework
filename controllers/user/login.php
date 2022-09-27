<?php
session_start();
$controller = new \classes\server\Controller();
$controller->setView('user/login');
$controller->get(function() use ($controller) {
   $controller->view();
});

$controller->post(function() {
    $userModel = new \models\authentication\UserModel();
});