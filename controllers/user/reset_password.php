<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$controller = new \classes\server\Controller();
$controller->setView("user/reset_password");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['errors'])) {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success'])) {
        $vars["success"] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() {
    if (empty($_POST["email"])) {
        $empty_errors[] = "The email is empty";
    }

    $email = $_POST["email"];

    $user = new \classes\authentication\User();
    $email_errors = $user->validateEmail($email);

    if (!empty($email_errors) || !empty($empty_errors)) {
        if (!empty($email_errors)) {
            $_SESSION['errors']['email_errors'] = $email_errors;
        }

        if (!empty($empty_errors)) {
            $_SESSION['errors']['empty_errors'] = $empty_errors;
        }

        redirect("/user/reset_password");
        die();
    }

    $_SESSION['success'] = 'If the email exists, Please allow up to 30 minutes for an email to sent. Although this should be near instant.';
    redirect("/user/reset_password");
});