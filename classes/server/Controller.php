<?php

namespace classes\server;

class Controller
{
    protected string $view;

    public function get(callable $callback): void {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $callback();
        }
    }

    public function post(callable $callback): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $callback();
        }
    }

    public function setView(string $viewLocation): void {
        $this->view = $viewLocation;
    }

    public function view(): void {
        require_once('views/' . $this->view . '.php');
    }
}