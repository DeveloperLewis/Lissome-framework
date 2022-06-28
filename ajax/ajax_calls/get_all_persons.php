<?php
    //Call static method to get all users from db
    $users = classes\models\user\User::getAll();

    foreach ($users as $user) {
        foreach ($user as $attr) {
            echo "<br>";
            echo $attr;
            echo "<br>";
        }
    }

