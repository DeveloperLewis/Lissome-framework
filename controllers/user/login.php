<?php
$con = new \classes\server\Controller();
$con->setView('user/login');
$con->get(fn()=>$con->view());