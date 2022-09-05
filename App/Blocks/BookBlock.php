<?php

namespace App\Blocks;

class BookBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/book.phtml';

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

        $temp = array_fill(0, 8, [
            'quantity' => '123',
            'libName'  => 'Chekhov',
        ]);

        $data['Libs'] = [$temp];

        return $data;
    }
}
