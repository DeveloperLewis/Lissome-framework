<?php
/** @var object $router */
/** @var object $middleware */
$router->get('/privacy-policy', function() {
    require_once('controllers/other/privacy_policy.php');
});

$router->get('/docs', function() {
    require_once('controllers/other/docs.php');
});