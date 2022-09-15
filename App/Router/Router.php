<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers(string $path): ?Controllers\AbstractController
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
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && stripos($uri, 'create') !== false) {
                return new $class();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'create') !== false) {
                $class = explode('\\', $class);
                $postName = 'Post' . array_pop($class);
                $class[] = $postName;
                $class = implode('\\', $class);

                return new $class();
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET' && stripos($uri, 'edit') !== false) {
                return new $class();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'edit') !== false) {
                $class = explode('\\', $class);
                $postName = 'Post' . array_pop($class);
                $class[] = $postName;
                $class = implode('\\', $class);

                return new $class();
            }

            return new $class();
        }

        return new Controllers\Error404Controller();
    }
}
