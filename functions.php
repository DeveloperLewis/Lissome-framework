<?php

use JetBrains\PhpStorm\NoReturn;

function dateAndTime(): ?string
{
    try {
        $timezone = 'Europe/London';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);

        return $dt->format('d/m/Y H:i:s');
    } catch (Exception $e) {
        error_log($e);
    }

    return null;
}

#[NoReturn] function redirect($url, $statusCode = 303): void
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function showErrors($errors_array): void
{
    if (!is_array($errors_array) || empty($errors_array)) {
        return;
    }

    foreach ($errors_array as $errors) {
        foreach ($errors as $error) {
            echo '<div class="text-center">';
            echo '<small class="text-danger">' . $error . '</small>';
            echo '</div>';
        }
    }
}

function showSuccess($success): void
{
    if (empty($success)) {
        return;
    }

    echo '<div class="text-center">';
    echo '<small class="text-success">' . $success . '</small>';
    echo '</div>';
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}
