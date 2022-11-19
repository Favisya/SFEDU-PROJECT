<?php

namespace App\Core\Router;

use Laminas\Di\Di;

abstract class AbstractRouter
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function handleUri(string $path): string
    {
        $slashSymbol  = strpos($path, '/');
        $questionMark = strpos($path, '?');

        if ($questionMark === false) {
            return substr($path, $slashSymbol + 1);
        }
        return substr($path, $slashSymbol + 1, $questionMark - 1);
    }
}
