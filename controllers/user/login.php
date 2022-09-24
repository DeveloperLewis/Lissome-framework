<?php
session_start();
$controller = new \classes\server\Controller();
$controller->setView('user/login');
$controller->get(fn() => $controller->view());