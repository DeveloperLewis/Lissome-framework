<?php

use classes\server\Controller;
use classes\validation\General;
use models\User;

$controller = new Controller();
$controller->get(function () use ($controller)
{
    $username = null;
    $email = null;
    $errorsArray = [];
    $success = null;


    if (isset($_SESSION['values']))
    {
        $username = $_SESSION['values']['username'];
        $email = $_SESSION['values']['email'];
        unset($_SESSION['values']);
    }

    if (isset($_SESSION['errors']))
    {
        $errorsArray = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    echo $controller->twig->render('user/register.twig', [
        'username' => $username,
        'email' => $email,
        'errorsArray' => $errorsArray,
        'success' => $success

    ]);
});

$controller->post(function ()
{
    if (!isset($_POST["checkbox"]))
    {
        redirect("/user/register");
    }


    $postArray = [$_POST["username"], $_POST["email"], $_POST["password"], $_POST["repeatPassword"]];

    //Empty validations
    $emptyValidator = new General();
    $emptyValidator->emptyInputs($postArray);
    $emptyErrors = $emptyValidator->getErrors();

    //POST variables to local variables
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeatPassword"];

    //Username validations
    $usernameValidator = new General();
    $usernameValidator->minLength($username, 3);
    $usernameValidator->maxLength($username, 30);
    $usernameValidator->lettersAndDigitsOnly($username);
    $usernameErrors = $usernameValidator->getErrors();

    //Email validations
    $emailValidator = new General();
    $emailValidator->minLength($email, 3);
    $emailValidator->maxLength($email, 320);
    $emailValidator->validateEmail($email);
    $emailValidator->isEmailUnique($email);
    $emailErrors = $emailValidator->getErrors();

    //Password validations
    $passwordValidator = new General();
    $passwordValidator->compareRepeatedPasswords($password, $repeat_password);
    $passwordValidator->minLength($password, 8);
    $passwordValidator->maxLength($password, 128);
    $passwordValidator->passwordRequirements($password);
    $passwordErrors = $passwordValidator->getErrors();


    //Start sessions for any errors and return to form with errors
    if (!empty($emptyErrors) || !empty($usernameErrors) || !empty($emailErrors) || !empty($passwordErrors))
    {
        $_SESSION['values']['username'] = $username;
        $_SESSION['values']['email'] = $email;

        $errorsArray = array_merge($emptyErrors, $usernameErrors, $emailErrors, $passwordErrors);
        $_SESSION['errors'] = $errorsArray;
        redirect("/user/register");
    }

    //Create new model of user
    $userModel = new User();
    $userModel->create($username, $email, $password, dateAndTime());

    //Store user in the database
    try
    {
        $userModel->store();
    } catch (Exception $e)
    {
        error_log($e);
        $_SESSION['errors']['store_errors'] = [$e];
        redirect("/user/register");
    }

    $_SESSION['success'] = 'Successfully created account. You can now log in.';
    redirect("/user/login");
});