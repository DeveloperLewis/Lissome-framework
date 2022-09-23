<?php
session_start();
$controller = new \classes\server\Controller();
$controller->setView("user/register");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['errors']))
    {
        $errors = $_SESSION['errors'];
    }
});

$controller->post(function() {

    //Check for empty POST inputs
    $empty_errors = [];
    if (empty($_POST["username"]))
    {
        $empty_errors[] = "The username is empty";
    }

    if (empty($_POST["email"]))
    {
        $empty_errors[] = "The email is empty";
    }

    if (empty($_POST["password"]))
    {
        $empty_errors[] = "The password is empty";
    }

    if (empty($_POST["repeat-password"]))
    {
        $empty_errors[] = "The repeat password is empty";
    }

    if (empty($_POST["checkbox"]))
    {
        $empty_errors[] = "You must agree to the privacy policy to signup";
    }

    if (!empty($empty_errors))
    {
        sendWithErrors("/user/register", $empty_errors);
    }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat-password"];

    $user = new \classes\authentication\User();
    $username_errors = $user->validateUsername($username);
    $email_errors = $user->validateEmail($email);
    $password_errors = $user->validatePassword($password, $repeat_password);

    if (!empty($username_errors))
    {
        sendWithErrors("/user/register", $username_errors);
    }

    if (!empty($email_errors))
    {
        sendWithErrors("/user/register", $email_errors);
    }

    if (!empty($password_errors))
    {
        sendWithErrors("/user/register", $password_errors);
    }
});