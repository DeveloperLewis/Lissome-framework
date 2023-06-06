<?php
use classes\server\Controller;
use models\User;

$controller = new Controller();
$controller->setView("user/login");
$controller->get(function() use ($controller)
{
    if (isset($_SESSION['errors']))
    {
        $errorsArray = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success']))
    {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    $controller->getView();
});

$controller->post(function()
{
    $userModel = new User();
    $userModel->email = $_POST["email"];
    $userModel->password =  $_POST["password"];

    //Try to log in the user
    try
    {
        $userModel->authenticate();
    }
    catch (Exception $e)
    {
        error_log($e);
        $_SESSION["errors"]["login"] = ["The password or email is incorrect, please try again."];
        redirect("/user/login");
    }

    //Try to retrieve the user
    try
    {
        $userModel->get();
    }
    catch (Exception $e)
    {
        error_log($e);
        $_SESSION["errors"]["login"] = ["There was an internal error. Please contact site administrator"];
        redirect("/user/login");
    }

    $_SESSION["user"]["user_id"] = $userModel->user_id;
    $_SESSION["user"]["ip"] = $_SERVER['REMOTE_ADDR'];
    $_SESSION["user"]["agent"] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION["user"]["last_access"] = time();
    redirect("/");
});