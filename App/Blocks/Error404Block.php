<?php

namespace App\Blocks;

class Error404Block extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/404.phtml';

    public function getData(): array
    {
        return [''];
    }
}
