<?php
use JetBrains\PhpStorm\NoReturn;

function dateAndTime(): string
{
    $timezone = 'Europe/London';
    $timestamp = time();
    $datetime = new DateTime("now", new DateTimeZone($timezone));
    $datetime->setTimestamp($timestamp);

    return $datetime->format('d/m/Y H:i:s');
}

#[NoReturn] function redirect($url, $statusCode = 303): void
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function showSuccess(string $success): void
{
    if (empty($success))
    {
        return;
    }

    echo '<div class="text-center">';
    echo '<small class="text-success">' . $success . '</small>';
    echo '</div>';
}

function isLoggedIn(): bool
{
    if (!isset($_SESSION['user']))
    {
        return false;
    }

    return true;
}

function yesNoLoop($prompt): bool {
    while (true) {
        $input = strtolower(readline($prompt));
        if ($input === "y") {
            return true;
        } elseif ($input === "n") {
            return false;
        }
        echo "Invalid input. Please enter 'y' or 'n'." . PHP_EOL;
    }
}

//Filters any directory path to be compatible with both linux/windows.
function universalDir(string $filePath): string
{
    return preg_replace("([/\\\\])", DIRECTORY_SEPARATOR, $filePath);
}