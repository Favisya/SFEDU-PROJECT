<?php

namespace App\Core\Router;

use App\Core\Exceptions\MvcException;
use App\Core\Controllers\Console;
use App\ModuleSettingsAggregator;

class ConsoleRouter extends AbstractRouter
{
    public function parseControllers(string $controller): ?Console\AbstractController
    {
        $class = ucfirst($controller);

        $mapping = $this->di->get(ModuleSettingsAggregator::class);
        $mapping = $mapping->getConRoutes();

        $controllerClass = $mapping[$class] ?? null;

        if (!$controllerClass) {
            throw new MvcException('Class does not exists');
        }

        return $this->di->get($controllerClass);
    }
}
