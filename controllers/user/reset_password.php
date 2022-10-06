<?php
$controller = new \classes\server\Controller();
$controller->setView("user/reset_password");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['success'])) {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['errors'])) {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() {
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
        $empty_errors[] = "The repeat passwrd cannot be empty";
    }

    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    $user = new \classes\authentication\User();
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

    echo "poo";
});