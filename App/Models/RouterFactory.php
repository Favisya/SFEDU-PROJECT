<?php

namespace App\Models;

use App\Router\AbstractRouter;
use App\Router\ApiRouter;
use App\Router\Router;
use Laminas\Di\Di;

class RouterFactory
{
    private $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function isApi(string $path): bool
    {
        $var = stripos($path, 'api/') !== false;
        return $var;
    }

    public function routerFactory(string $path): AbstractRouter
    {
        if (!$this->isApi($path)) {
            /**
             * @return AbstractRouter
             */
            return $this->di->get(Router::class);
        }
        /**
         * @return AbstractRouter
         */
        return $this->di->get(ApiRouter::class);
    }
}