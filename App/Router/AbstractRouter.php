<?php

namespace App\Router;

abstract class AbstractRouter
{
    public function handleUri(string $path): string
    {
        $slashSymbol  = strpos($path, '/');
        $questionMark = strpos($path, '?');

        if ($questionMark === false) {
            return substr($path, $slashSymbol + 1);
        }
        return substr($path, $slashSymbol + 1, $questionMark - 1);
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
