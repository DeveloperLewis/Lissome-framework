<?php

namespace classes\server;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    public Environment $twig;
    protected string $view;

    public function __construct()
    {
        $loader = new FilesystemLoader(universalDir('views'));
        $this->twig = new Environment($loader);

        if (isset($_SESSION["user"]["user_id"]))
        {
            $this->twig->addGlobal("loggedIn", true);
        }
    }

    //Assign callback to a get request
    public function get(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $callback();
        }
    }

    //Assign callback to a post request
    public function post(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $callback();
        }
    }


}