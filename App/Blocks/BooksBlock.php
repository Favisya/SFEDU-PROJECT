<?php

namespace App\Blocks;

class BooksBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/books/Books.phtml';
    }

    public function getData(): array
    {
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $data[] = [
                'name'    => 'Идиот',
                'author'  => 'Достоевский Ф.М.',
            ];
        }

        return $data;
    }
}
