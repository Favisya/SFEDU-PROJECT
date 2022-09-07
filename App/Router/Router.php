<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers(string $path): ?Controllers\ControllerInterface
    {
        $firstSymbol  = strpos($path, '/');
        $secondSymbol = strpos($path, '?');

        if ($secondSymbol === false) {
            $uri = substr($path, $firstSymbol + 1);
        } else {
            $uri = substr($path, $firstSymbol + 1, $secondSymbol - 1);
        }

        if ($uri == '') {
            return new Controllers\HomePageController();
        }

        $class = ucfirst($uri);
        $class = $class . 'Controller';

        $class = 'App\Controllers\\' . $class;

        if (class_exists($class)) {
            return new $class();
        }

        return new Controllers\Error404Controller();
    }
}
