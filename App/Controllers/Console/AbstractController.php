<?php

namespace App\Controllers\Console;

use Laminas\Di\Di;

abstract class AbstractController extends \App\Controllers\AbstractController
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
