<?php

namespace App\Blocks;

class Error404Block extends BlocksAbstract
{
    protected $template = '404';

    public function getData(): array
    {
        return [''];
    }
}
