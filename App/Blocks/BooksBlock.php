<?php

namespace App\Blocks;

class BooksBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('books', $this);
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
