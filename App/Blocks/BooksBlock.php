<?php

namespace App\Blocks;

class BooksBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/books.phtml';

    public function getData(): array
    {
        return array_fill(0, 30, [
            'name'    => 'Идиот',
            'author'  => 'Достоевский Ф.М.',
        ]);
    }
}
