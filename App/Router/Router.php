<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers(string $path): ?Controllers\ControllerInterface
    {
        $uri = explode('/', $path);

        if ($uri[1] == '') {
            return new Controllers\HomePageController();
        }

        $class = ucfirst($uri[1]);
        $class = $class . 'Controller';

        $class = 'App\Controllers\\' . $class;

        if (class_exists($class)) {
            return new $class();
        }
        return new Controllers\Error404Controller();
    }
}
