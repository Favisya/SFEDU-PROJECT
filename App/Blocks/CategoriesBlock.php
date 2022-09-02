<?php

namespace App\Blocks;

class CategoriesBlock implements BlocksInterface
{
    private $fileToRender = APP_ROOT . '/App/View/categories.phtml';

    public function render()
    {
        $footer = new FooterBlock();
        $header = new HeaderBlock();
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [
            'худ литература1',
            'худ литература2',
            'худ литература3',
            'худ литература4',
        ];

        return $data;
    }
}
