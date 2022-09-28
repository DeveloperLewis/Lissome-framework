<?php
$controller = new \classes\server\Controller();
$controller->setView("index");
$controller->get(function() use ($controller) {
    if (isset($_SESSION["user"])) {
        $userModel = new \models\authentication\UserModel();
        $userModel->user_id = $_SESSION["user"]["user_id"];

        try {
            $userModel->get();
            $vars["username"] = $userModel->username;
        } catch (Exception $e) {
            error_log($e);
        }
    }

    $controller->view($vars ?? null, null);
});
