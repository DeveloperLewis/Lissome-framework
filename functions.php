<?php

function dateAndTime(): string
{
    try {
        $timezone = 'Europe/London';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);
    } catch (Exception $e) {
        error_log($e);
    }
    return $dt->format('d/m/Y H:i:s');
}

function redirect($url, $statusCode = 303): void
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function showErrors($errors_array): void {
    if (empty($errors_array)) {
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

function showSuccess($success): void {
    if (empty($success)) {
        return;
    }

    echo '<div class="text-center">';
    echo '<small class="text-success">' . $success . '</small>';
    echo '</div>';
}