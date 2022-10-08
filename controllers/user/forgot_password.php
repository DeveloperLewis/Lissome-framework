<?php

use classes\server\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$controller = new Controller();
$controller->setView("user/forgot_password");
$controller->get(function () use ($controller)
{
    if (isset($_SESSION['errors'])) {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    $controller->view();
});

$controller->post(function ()
{
    if (empty($_POST["email"])) {
        $empty_errors[] = "The email is empty";
    }

    $email = $_POST["email"];

    if (strlen($email) < 3) {
        $email_errors['min_size'] = "Your email address must be greater than 3 characters.";
    }

    if (strlen($email) > 320) {
        $email_errors['max_size'] = "Your email address must be less than 320 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_errors['invalid'] = "This email address is not valid.";
    }

    if (!empty($email_errors) || !empty($empty_errors)) {
        if (!empty($email_errors)) {
            $_SESSION['errors']['email_errors'] = $email_errors;
        }

        if (!empty($empty_errors)) {
            $_SESSION['errors']['empty_errors'] = $empty_errors;
        }

        redirect("/user/forgot_password");
        die();
    }

    try {
        $token = bin2hex(random_bytes(6));
    } catch (\Exception $e) {
        error_log($e);
    }

    $_SESSION["token"] = $token;
    $_SESSION["email"] = $email;

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'YOUR HOST';
        $mail->SMTPAuth = true;
        $mail->Username = 'YOUR USERNAME';
        $mail->Password = 'YOUR PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('FROM@YOUREMAIL.COM', 'MAILER');
        $mail->addAddress($email);

        //Content
        $mail->isHTML();                                  //Set email format to HTML
        $mail->Subject = "Password Reset";
        $mail->Body = 'Please copy this token into the form that you have been redirected to: ' . $token . '<br>This
            token will only last 30 minutes';
        $mail->AltBody = 'Please copy this token into the form that you have been redirected to: ' . $token . ' 
        This token will only last 30 minutes';

        $mail->send();
    } catch (Exception $e) {
        error_log($e);
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    $_SESSION['success'] = 'If the email exists, Please allow up to 30 minutes for an email to sent.';
    redirect("/user/reset_password");
});
