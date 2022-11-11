<?php

namespace App\Models;

use App\Router\AbstractRouter;
use App\Router\ApiRouter;
use App\Router\Router;

class RouterFactory
{
    private $webRouter;
    private $apiRouter;

    public function __construct(Router $webRouter, ApiRouter $apiRouter)
    {
        $this->webRouter = $webRouter;
        $this->apiRouter = $apiRouter;
    }

    public function isApi(string $path): bool
    {
        return stripos($path, 'api/') !== false;
    }

    public function routerFactory(string $path): AbstractRouter
    {
        if (!$this->isApi($path)) {
            return $this->webRouter;
        }

        return $this->apiRouter;
    }
}