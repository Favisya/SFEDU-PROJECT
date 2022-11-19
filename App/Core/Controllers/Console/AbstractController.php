<?php

namespace App\Core\Controllers\Console;

use Laminas\Di\Di;

abstract class AbstractController extends \App\Core\Controllers\AbstractController
{
    private $argument;

    public function setArguments(array $argument): void
    {
        $this->argument = $argument;
    }

    public function getArguments(): array
    {
        return $this->argument;
    }
}
