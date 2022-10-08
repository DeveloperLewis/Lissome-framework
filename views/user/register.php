<!DOCTYPE html>
<html lang = "en">
<?php require_once('views/includes/header.php'); ?>
<body>
<?php require_once('views/includes/nav.php'); ?>
<div class = "row">
    <div class = "col">

    </div>
    <div class = "col-lg-3">
        <div class = "card bg-dark text-white mt-5 mx-2">
            <div class = "container">
                <div class = "m-4">
                    <h3 class = "text-center">Register Account</h3>
                </div>

                <?php
                //Errors and Success Messages
                showErrors($errors_array ?? "");
                showSuccess($vars['success'] ?? "");
                ?>

                <form action = "/user/register" method = "POST">
                    <div class = "mb-3">
                        <label for = "username" class = "form-label">Username</label>
                        <input type = "text" class = "form-control dark-input" name = "username" id = "username"
                               value = "<?= $vars["username"] ?? "" ?>">
                    </div>
                    <div class = "mb-3">
                        <label for = "email" class = "form-label">Email Address</label>
                        <input type = "email" class = "form-control dark-input" name = "email" id = "email"
                               value = "<?= $vars["email"] ?? "" ?>">
                    </div>
                    <div class = "mb-3">
                        <label for = "password" class = "form-label">Password</label>
                        <input type = "password" class = "form-control dark-input" name = "password" id = "password">
                    </div>
                    <div class = "mb-3">
                        <label for = "repeat-password" class = "form-label">Repeat Password</label>
                        <input type = "password" class = "form-control dark-input" name = "repeat-password"
                               id = "repeat-password">
                    </div>
                    <div class = "form-check d-flex justify-content-center">
                        <input class = "form-check-input" type = "checkbox" value = "" name = "checkbox" id = "checkbox">
                        <label class = "form-check-label mx-1" for = "checkbox">By signing up you agree to our
                            <a href = "/privacy-policy">Privacy Policy</a>
                        </label>
                    </div>

                    <div class = "mt-3 mb-2 d-flex justify-content-center">
                        <button class = "btn btn-primary flex-fill" type = "submit">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class = "col">

    </div>
</div>
<?php require_once('views/includes/footer.php'); ?>
</body>
</html>
