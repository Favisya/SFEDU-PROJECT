<?php

namespace App\Controllers;

abstract class ControllerAbstract
{
    public function execute()
    {

    }

    public function isGetMethod(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        }

        return false;
    }
}
