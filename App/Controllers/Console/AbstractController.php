<?php

namespace App\Controllers\Console;

abstract class AbstractController extends \App\Controllers\AbstractController
{
    private $argument;

    public function setArgument(array $argument): void
    {
        $this->argument = $argument;
    }

    public function getArgument(): array
    {
        return $this->argument;
    }
}
