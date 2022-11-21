<?php

namespace App\Core\Models\DiContainer;

use App\Core\Controllers\Error404Controller;
use App\Core\Models\Resource\Environment;
use App\Core\Router\ApiRouter;
use App\Core\Router\ConsoleRouter;
use App\Core\Router\Router;

abstract class AbstractDiC
{
    protected $di;
    protected $instanceManager;

    public function __construct(\Laminas\Di\Di $di)
    {
        $this->di = $di;
        $this->instanceManager = $this->di->instanceManager();
    }

    public function assemble()
    {
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if (strpos($method->getName(), 'assemble') === 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }
}
