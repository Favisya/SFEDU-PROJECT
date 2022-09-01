<?php

namespace App\Controllers;

class Error404Controller implements ControllerInterface
{
    public function execute()
    {
        echo 'This is controller for 404 error' . PHP_EOL;
    }
}
