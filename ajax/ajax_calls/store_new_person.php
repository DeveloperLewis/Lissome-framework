<?php

if (isset($_POST['name']) && isset($_POST['age'])) {
    $user = new classes\models\user\User($_POST['firstName'], $_POST['email'], $_POST['password']);
    if ($user->store()) {
       echo "Successfully stored the user.";
    } else {
       echo "There was an error storing the user.";
    }
}