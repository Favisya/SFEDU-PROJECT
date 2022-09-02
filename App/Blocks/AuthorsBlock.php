<?php

namespace App\Blocks;

class AuthorsBlock implements BlocksInterface
{
    private $fileToRender = APP_ROOT . '/App/View/authors.phtml';

    public function render()
    {
        $footer = new FooterBlock();
        $header = new HeaderBlock();
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [
            'Пушкин',
            'Чехов',
            'Достоевский',
            'Лермонтов',
        ];
    }
}
