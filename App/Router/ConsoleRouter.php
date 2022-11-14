<?php

namespace App\Router;

use App\Exceptions\MvcException;
use App\Controllers\Console;
use Laminas\Di\Di;

class ConsoleRouter extends AbstractRouter
{
    public function parseControllers(string $controller): ?Console\AbstractController
    {
        $class = ucfirst($controller);
        $class = $class . 'Controller';

        $class = 'App\Controllers\Console\\' . $class;

        if (class_exists($class)) {
            return $this->di->get($class);
        }

        throw new MvcException('Class does not exists');
    }
}
