<?php

use classes\authentication\User;
use classes\server\Controller;
use classes\server\Database;

$controller = new Controller();
$controller->setView("user/reset_password");
$controller->get(function () use ($controller)
{
    if (isset($_SESSION['success'])) {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['errors'])) {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    $controller->view();
});

$controller->post(function ()
{
    if (empty($_POST['token'])) {
        $empty_errors[] = "The token cannot be empty.";
    }

    if ($_POST['token'] != $_SESSION['token']) {
        $token_errors[] = "The token does not match.";
    }

    if (!isset($_POST['password'])) {
        $empty_errors[] = "The password cannot be empty.";
    }

    if (!isset($_POST['repeat_password'])) {
        $empty_errors[] = "The repeat password cannot be empty";
    }

    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    $user = new User();
    $password_errors = $user->validatePassword($password, $repeat_password);

    if (!empty($token_errors) || !empty($password_errors) || !empty($empty_errors)) {
        if (!empty($token_errors)) {
            $_SESSION['errors']['token_errors'] = $token_errors;
        }

        if (!empty($password_errors)) {
            $_SESSION['errors']['password_errors'] = $password_errors;
        }

        if (!empty($empty_errors)) {
            $_SESSION['errors']['empty_errors'] = $empty_errors;
        }

        redirect("/user/reset_password");
    }
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION["email"];
    unset($_SESSION["email"]);

    $database = new Database();
    $stmt = $database->getPdo()->prepare("UPDATE users SET password = ? WHERE email = ?");
    if (!$stmt->execute([$hashed, $email])) {
        $_SESSION['errors']['password_reset'] = ["Something went wrong. Please contact website administrator"];
        error_log("Failed to update the user password in the database");
        redirect("/user/reset_password");
    }

    unset($_SESSION["token"]);
    $_SESSION["success"] = "Successfully changed password, you can now login again.";
    redirect("/user/login");
});
