<?php
$con = new \classes\server\Controller();
$con->setView("index");
$con->get(fn() => $con->view());
