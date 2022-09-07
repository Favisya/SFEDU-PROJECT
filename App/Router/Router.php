<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers(string $path): ?Controllers\ControllerInterface
    {
        $uri = explode('/', $path);
        $uri = explode('?', $uri[1]);

        if ($uri[0] == '') {
            return new Controllers\HomePageController();
        }

        $class = ucfirst($uri[0]);
        $class = $class . 'Controller';

        $class = 'App\Controllers\\' . $class;

        if (class_exists($class)) {
            return new $class();
        }
        return new Controllers\Error404Controller();
    }
}
