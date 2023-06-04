<?php
namespace classes\server;

class Controller
{
    protected string $view;

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

    //Set a view for the controller to use
    public function setView(string $viewLocation): void
    {
        $this->view = $viewLocation;
    }

    //Get the view from views directory
    public function getView(): void
    {
        require_once('views/' . $this->view . '.php');
    }
}