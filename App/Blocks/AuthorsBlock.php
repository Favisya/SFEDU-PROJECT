<?php

namespace App\Blocks;

class AuthorsBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/authors/authors.phtml';
    }

    public function getData(): array
    {
        $data = [
            'Пушкин',
            'Чехов',
            'Достоевский',
            'Лермонтов',
        ];

        return $data;
    }
}
