<?php

namespace App\Blocks;

class HomePageBlock extends BlockAbstract
{
    protected $template = 'homepage';

    public function getData(): array
    {
        return [''];
    }
}
