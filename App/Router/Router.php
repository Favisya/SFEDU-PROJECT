<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers (string $path)
    {
        switch ($path) {
            case '/':
                echo 'Welcome to homepage';
                break;

            case '/Authors':
                $controller = new Controllers\Authors();
                $controller->showControllerName();
                break;

            case '/Books':
                $controller = new Controllers\Books();
                $controller->showControllerName();
                break;
            case '/Categories':
                $controller = new Controllers\Categories();
                $controller->showControllerName();
                break;
            case '/Countries':
                $controller = new Controllers\Countries();
                $controller->showControllerName();
                break;
            case '/Libraries':
                $controller = new Controllers\Libraries();
                $controller->showControllerName();
                break;
            case '/Publishers':
                $controller = new Controllers\Publishers();
                $controller->showControllerName();
                break;
            case '/Racks':
                $controller = new Controllers\Racks();
                $controller->showControllerName();
                break;
            default:
                echo '404' . PHP_EOL;
                break;
        }
    }
}