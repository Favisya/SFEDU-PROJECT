<?php

namespace App\Blocks;

class HomePageBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/homepage.phtml';

    public function getData(): array
    {
        return [''];
    }
}
