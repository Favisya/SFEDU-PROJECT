<?php

namespace App\Blocks;

class BooksBlock implements BlocksInterface
{
    private $fileToRender = APP_ROOT . '/App/View/books.phtml';

    public function render()
    {
        $footer = new FooterBlock();
        $header = new HeaderBlock();
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        $data = array_fill(0,30, [
            'name'    => 'Идиот',
            'author'  => 'Достоевский Ф.М.',
        ]);

        return $data;
    }
}
