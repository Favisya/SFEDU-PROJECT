<?php

namespace App\Blocks;

class PublishersBlock implements BlocksInterface
{
    private $fileToRender = APP_ROOT . '/App/View/publishers.phtml';

    public function render()
    {
        $footer = new FooterBlock();
        $header = new HeaderBlock();
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [
            'Эскма',
            'Приколы',
            'фывфыв',
            'Приколыв 12321',
        ];
    }
}
