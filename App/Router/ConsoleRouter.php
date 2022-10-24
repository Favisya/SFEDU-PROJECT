<?php

namespace App\Router;

use App\Exceptions\MvcException;
use App\Controllers\Console;

class ConsoleRouter extends AbstractRouter
{
    public function parseControllers(string $path): ?Console\AbstractController
    {
        $controller = $path;

        $class = ucfirst($controller);
        $class = $class . 'Controller';

        $class = 'App\Controllers\Console\\' . $class;

        if (class_exists($class)) {
            return new $class();
        }

        throw new MvcException('Class does not exists');
    }
}
