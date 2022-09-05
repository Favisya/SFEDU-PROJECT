<?php

namespace App\Blocks;

class AuthorsBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/authors.phtml';

    public function getData(): array
    {
        return [
            'Пушкин',
            'Чехов',
            'Достоевский',
            'Лермонтов',
        ];
    }
}
