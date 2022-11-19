<?php

namespace App\Books\Models;

use App\Core\Router\AbstractRouter;
use App\Core\Router\ApiRouter;
use App\Core\Router\Router;

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