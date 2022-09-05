<?php

namespace App\Blocks;

class BooksBlock extends BlocksAbstract
{
    protected $template = 'books';

    public function getData(): array
    {
        return array_fill(0, 30, [
            'name'    => 'Идиот',
            'author'  => 'Достоевский Ф.М.',
        ]);
    }
}
