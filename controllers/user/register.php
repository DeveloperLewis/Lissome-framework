<?php
use classes\server\Controller;
use classes\validation\GeneralValidation;
use models\authentication\UserModel;

$controller = new Controller();
$controller->setView("user/register");
$controller->get(function() use ($controller)
{
    if (isset($_SESSION['values']))
    {
        $vars["username"] = $_SESSION['values']['username'];
        $vars["email"] = $_SESSION['values']['email'];
        unset($_SESSION['values']);
    }

    if (isset($_SESSION['errors']))
    {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success']))
    {
        $vars["success"] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    $controller->getView();
});

$controller->post(function ()
{

    $postArray = [$_POST["username"], $_POST["email"], $_POST["password"], $_POST["repeat-password"], $_POST["checkbox"]];

    //Empty validations
    $emptyValidator = new GeneralValidation();
    $emptyValidator->emptyInputs($postArray);
    $emptyErrors = $emptyValidator->getErrors();

    //POST variables to local variables
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat-password"];

    //Username validations
    $usernameValidator = new GeneralValidation();
    $usernameValidator->minLength($username,3 );
    $usernameValidator->maxLength($username, 30);
    $usernameValidator->LettersAndDigitsOnly($username);
    $usernameErrors = $usernameValidator->getErrors();

    //Email validations
    $emailValidator = new GeneralValidation();
    $emailValidator->minLength($email, 3);
    $emailValidator->maxLength($email, 320);
    $emailValidator->validateEmail($email);
    $emailValidator->isEmailUnique($email);
    $emailErrors = $emailValidator->getErrors();

    //Password validations
    $passwordValidator = new GeneralValidation();
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
        redirect("/user/register");
    }

    //Create new model of user
    $userModel = new UserModel();
    $userModel->create($username, $email, $password, dateAndTime());

    //Store user in the database
    try
    {
        $userModel->store();
    }
    catch (Exception $e)
    {
        error_log($e);
        $_SESSION['errors']['store_errors'] = [$e];
        redirect("/user/register");
    }

    $_SESSION['success'] = 'Successfully created account. <a href="/user/login" class="remove-underline">Login here.</a>';
    redirect("/user/register");
});