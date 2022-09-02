<?php

namespace App\Blocks;

interface BlocksInterface
{
    public function render();

    public function getData(): array;
}
