<?php

function dateAndTime(): string
{
    try
    {
        $timezone = 'Europe/London';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);
    }
    catch (Exception $e)
    {
        error_log($e);
    }
    return $dt->format('d/m/Y H:i:s');
}

function redirect($url, $statusCode = 303): void
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function showErrors($errors_array): void
{
    if (empty($errors_array))
    {
        return;
    }

    foreach ($errors_array as $errors)
    {
        foreach ($errors as $error)
        {
            echo '<div class="text-center">';
            echo '<small class="text-danger">' . $error . '</small>';
            echo '</div>';
        }
    }
}

function showSuccess($success): void
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