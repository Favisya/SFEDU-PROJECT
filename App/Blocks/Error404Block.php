<?php

namespace App\Blocks;

class Error404Block implements BlocksInterface
{
    private $fileToRender = APP_ROOT . '/App/View/404.phtml';

    public function render()
    {
        $footer = new FooterBlock();
        $header = new HeaderBlock();
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [''];
    }
}