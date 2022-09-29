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

    try {
        $token = bin2hex(random_bytes(16));
    } catch (\Exception $e) {
        error_log($e);
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'YOUR HOST';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'YOUR USERNAME';
        $mail->Password   = 'YOUR PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('FROM@YOUREMAIL.COM', 'MAILER');
        $mail->addAddress($email);

        //Content
        $body = '<p>Please click here to <a href="/user/reset_password/reset?token=">reset your password</a></p>';
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Password Reset";
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        error_log($e);
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    $_SESSION['success'] = 'If the email exists, Please allow up to 30 minutes for an email to sent. Although this should be near instant.';
    redirect("/user/reset_password");
});