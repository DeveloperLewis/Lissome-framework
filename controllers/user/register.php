<?php
$controller = new \classes\server\Controller();
$controller->setView("user/register");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['values'])) {
        $vars["username"] = $_SESSION['values']['username'];
        $vars["email"] = $_SESSION['values']['email'];
        unset($_SESSION['values']);
    }

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

$controller->post(function () {

    //Check for empty POST inputs
    $empty_errors = [];
    if (empty($_POST["username"])) {
        $empty_errors[] = "The username is empty";
    }

    if (empty($_POST["email"])) {
        $empty_errors[] = "The email is empty";
    }

    if (empty($_POST["password"])) {
        $empty_errors[] = "The password is empty";
    }

    if (empty($_POST["repeat-password"])) {
        $empty_errors[] = "The repeat password is empty";
    }

    if (!isset($_POST["checkbox"])) {
        $empty_errors[] = "You must agree to the privacy policy to signup";
    }

    //Set to variables
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat-password"];

    //Validate variables and check for any errors
    $user = new \classes\authentication\User();
    $username_errors = $user->validateUsername($username);
    $email_errors = $user->validateEmail($email);
    $password_errors = $user->validatePassword($password, $repeat_password);

    //Start sessions for any errors and return to form with errors
    if (!empty($empty_errors) || !empty($username_errors) || !empty($email_errors) || !empty($password_errors)) {
        if (!empty($username_errors)) {
            $_SESSION['errors']['username_errors'] = $username_errors;
        }

        if (!empty($email_errors)) {
            $_SESSION['errors']['email_errors'] = $email_errors;
        }

        if (!empty($password_errors)) {
            $_SESSION['errors']['password_errors'] = $password_errors;
        }

        if (!empty($empty_errors)) {
            $_SESSION['errors']['empty_errors'] = $empty_errors;
        }

        $_SESSION['values']['username'] = $username;
        $_SESSION['values']['email'] = $email;
        redirect("/user/register");
    }

    //Create new model of user
    $userModel = new \models\authentication\UserModel();
    $userModel->create($username, $email, $password, dateAndTime());

    //Store user in the database
    try {
        $userModel->store();
    } catch (Exception $e) {
        error_log($e);
        $_SESSION['errors']['store_errors'] = [$e];
        redirect("/user/register");
        die();
    }

    $_SESSION['success'] = 'Successfully created account. <a href="/user/login" class="remove-underline">Login here.</a>';
    redirect("/user/register");
    die();
});