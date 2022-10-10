<?php

namespace App\Router;

use App\Controllers\Api\AbstractApiController;
use App\Controllers\Api\CreateAuthorController;

class ApiRouter extends AbstractRouter
{
    private const ID         = 2;
    private const CONTROLLER = 1;

    public function parseControllers(string $path): ?AbstractApiController
    {
        $uri = explode('/', $path);
        array_shift($uri);
        $id         = $uri[self::ID] ?? null;
        $controller = $uri[self::CONTROLLER];

        $class = ucfirst($controller);
        $class = $class . 'Controller';

        $class = 'App\Controllers\Api\\' . $class;

        if (class_exists($class)) {
            return new $class($id);
        }

        return null;
    }
}
