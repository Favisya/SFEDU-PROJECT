<?php

namespace App\Controllers\Console;

abstract class AbstractController extends \App\Controllers\AbstractController
{
    private $argument;

    public function setArgument(string $fileFormat): void
    {
        $this->argument = $fileFormat;
    }

    public function getArgument(): string
    {
        return $this->argument;
    }
}
