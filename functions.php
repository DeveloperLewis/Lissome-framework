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