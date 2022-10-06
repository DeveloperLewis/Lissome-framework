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
                    <h3 class="text-center">Forgot Password</h3>
                </div>

                <?php
                    //Errors
                    showErrors($errors_array ?? "");
                ?>

                <form action="/user/forgot_password" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="text" class="form-control dark-input" name="email" id="email">
                    </div>

                    <div class="mb-2 float-end">
                        <button class="btn btn-primary" type="submit">Send Link</button>
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