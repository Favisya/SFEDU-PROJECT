<?php

namespace App\Blocks;

class AuthorsBlock extends BlocksAbstract
{
    protected $template = 'authors';

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
