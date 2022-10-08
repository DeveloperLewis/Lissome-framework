<!DOCTYPE html>
<html lang = "en">
<?php require_once('includes/header.php'); ?>
<body>
<?php require_once('includes/nav.php'); ?>

<div class = "text-white text-center mt-5">
    <h1 class = "lato-light">Lissome <span class = "lato-strong">Framework</span></h1>
    <h4 class = "lato-light">Lissome is a slim and fast php framework for building MVC applications. </h4>
</div>

<?php if (isloggedIn()) { ?>
    <p class = "text-center text-white">You are logged in, <?= $vars["username"] ?? "N/A" ?></p>
<?php } ?>


<?php require_once('includes/footer.php'); ?>
</body>
</html>
