<?php

namespace App\Blocks;

class BookBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/books/Book.phtml';
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

        $temp = [];

        for ($i = 0; $i < 6; $i++) {
            $temp[] = [
                'quantity' => '123',
                'libName'  => 'Chekhov',
            ];
        }

        $data['Libs'] = [$temp];

        return $data;
    }
}
