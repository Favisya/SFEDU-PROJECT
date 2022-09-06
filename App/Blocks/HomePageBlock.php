<?php

namespace App\Blocks;

class HomePageBlock extends BlockAbstract
{
    protected $template = APP_ROOT . 'homepage';

    public function getData(): array
    {
        return [''];
    }
}
