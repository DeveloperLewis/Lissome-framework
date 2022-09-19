<?php
$con = new \classes\server\Controller();
$con->setView('user/register');

$con->get(fn()=>$con->view());

$con->post(function() {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat-password'];
    $checkbox = $_POST['checkbox'];

});