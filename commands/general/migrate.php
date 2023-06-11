<?php

use migrations\User;

//Add all new migration classes here
$user = new User();

//Migrate classes
$migrations = [$user];

foreach ($migrations as $migrate)
{
    $migrate->runMigrations();
}