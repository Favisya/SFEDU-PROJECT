<?php

namespace App\Blocks;

class PublishersBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/publishers/publishers.phtml';
    }

    public function getData(): array
    {
        $data = [
            'Эскма',
            'Приколы',
            'фывфыв',
            'Приколыв 12321',
        ];

        return $data;
    }
}
