<?php
session_start();
$controller = new \classes\server\Controller();
$controller->setView("index");
$controller->get(fn() => $controller->view());
