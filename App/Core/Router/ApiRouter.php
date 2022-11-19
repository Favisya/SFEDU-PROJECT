<?php

namespace App\Core\Router;

use App\Core\Controllers\Api\AbstractApiController;
use App\ModuleSettingsAggregator;

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

        $mapping = $this->di->get(ModuleSettingsAggregator::class);
        $mapping = $mapping->getApiRoutes();

        $controllerClass = $mapping[$class] ?? null;

        if (!$controllerClass) {
            header('Status: 404');
            return null;
        }

        return $this->di->get($controllerClass, ['param'=> $id]);
    }
}
