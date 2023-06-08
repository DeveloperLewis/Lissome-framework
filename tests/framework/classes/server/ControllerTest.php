<?php

namespace classes\server;

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    private Controller $controller;

    private function getController()
    {
        $this->controller = new Controller();
    }

    public function testSetView()
    {
        $this->getController();
        $this->controller->setView("New View");
        $result = $this->controller->view;
        $this->assertSame("New View", $result);

    }
}