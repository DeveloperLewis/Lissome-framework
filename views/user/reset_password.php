<!DOCTYPE html>
<html lang="en">
<?php require_once('views/includes/header.php'); ?>
<body>
<?php require_once('views/includes/nav.php'); ?>
<div class="row">
    <div class="col">

    </div>
    <div class="col-lg-3">
        <div class="card bg-dark text-white mt-5 mx-2">
            <div class="container">
                <div class="m-4">
                    <h3 class="text-center">Reset Password</h3>
                </div>

                <?php
                //Errors and Success Messages
                showErrors($errors_array ?? "");
                showSuccess($vars['success'] ?? "");
                ?>

                <form action="/user/reset_password" method="POST">
                    <div class="mb-3">
                        <label for="token" class="form-label">Token</label>
                        <input type="text" class="form-control dark-input" name="token" id="token">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control dark-input" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="repeat_password" class="form-label">Repeat New Password</label>
                        <input type="password" class="form-control dark-input" name="repeat_password" id="repeat_password">
                    </div>

                    <div class="mb-2 float-end">
                        <button class="btn btn-primary" type="submit">Reset Password</button>
                    </div>

                    <div class="mb-2 float-start">
                        <a class="btn btn-danger" href="/user/login">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col">

    </div>
</div>
<?php require_once('views/includes/footer.php'); ?>
</body>
</html>