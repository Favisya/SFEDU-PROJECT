<?php

namespace App\Models;

use App\Controllers\Error404Controller;
use App\Models\Resource\AuthorResource;

class DiC
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

    protected function assembleWeb()
    {
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PRIVATE) as $method) {
            if (strpos($method->getName(), 'assembleWeb') === 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }


    private function assembleWebAuthor()
    {
        $this->instanceManager->setParameters(
            'App\Controllers\AuthorController',
            [
                'resource' => $this->di->get('App\Models\Resource\AuthorResource'),
                'block'    => $this->di->get('App\Blocks\AuthorBlock'),
            ]
        );
    }

    private function assembleWeb404()
    {
        $this->instanceManager->setParameters(
            Error404Controller::class,
            [
                'resource' => $this->di->get(\App\Models\Resource\AuthorsResource::class),
                'block'    => $this->di->get(\App\Blocks\SimpleBlock::class),
            ]
        );
    }
}
