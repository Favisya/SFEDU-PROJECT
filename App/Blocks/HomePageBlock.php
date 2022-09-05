<?php

namespace App\Blocks;

class HomePageBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . 'homepage';

    public function getData(): array
    {
        return [''];
    }
}
