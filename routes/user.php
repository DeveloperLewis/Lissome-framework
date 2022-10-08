<?php
/** @var object $router */
/** @var object $middleware */
$router->get('/user/register', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/register.php');
});

$router->post('/user/register', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/register.php');
});

$router->get('/user/login', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/login.php');
});

$router->post('/user/login', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/login.php');
});

$router->get('/user/logout', function () use ($middleware)
{
    $middleware->authenticateUser();
    require_once('controllers/user/logout.php');
});

$router->get('/user/forgot_password', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/forgot_password.php');
});

$router->post('/user/forgot_password', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/forgot_password.php');
});

$router->get('/user/reset_password', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/reset_password.php');
});

$router->post('/user/reset_password', function ()
{
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/reset_password.php');
});
