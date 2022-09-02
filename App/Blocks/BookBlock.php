<?php

namespace App\Blocks;

class BookBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('book', $this);
    }

    public function getData(): array
    {
        $data['bookData'] = [
            'author'    => 'Достовевский Ф.М',
            'name'      => 'Идиот',
            'year'      => '1869',
            'country'   => 'Россия',
            'publisher' => 'Эскмо',
            'price'     => '680р',
            'category'  => 'Художественная литература',
        ];

        $temp = array_fill(0,8, [
            'quantity' => '123',
            'libName'  => 'Chekhov',
        ]);

        $data['Libs'] = [$temp];

        return $data;
    }
}
