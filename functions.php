<?php
function sendWithErrors($url, $errors): void {
    $_SESSION['errors'] = $errors;
    header('Location: ' . $url);
    die();
}

/**
 * @throws Exception
 */
function dateAndTime(): string {
    $timezone = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($timezone));
    $dt->setTimestamp($timestamp);
    return $dt->format('d/m/Y H:i:s');
}