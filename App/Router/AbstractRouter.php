<?php

namespace App\Router;

abstract class AbstractRouter
{
    public function handleUri(string $path): string
    {
        $firstSymbol  = strpos($path, '/');
        $secondSymbol = strpos($path, '?');

        if ($secondSymbol === false) {
            return substr($path, $firstSymbol + 1);
        }
        return substr($path, $firstSymbol + 1, $secondSymbol - 1);
    }

    public function isApi(string $path): bool
    {
        return stripos($path, 'api/') === false;
    }

    public function routerFactory(string $path): ?AbstractRouter
    {
        if ($this->isApi($path)) {
            return new Router();
        }
        return new ApiRouter();
    }
}
