<?php

namespace App\Blocks;

class Error404Block extends BlockAbstract
{
    protected $template = '404';

    public function getData(): array
    {
        return [''];
    }
}
