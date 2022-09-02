<?php

namespace App\Blocks;

class AuthorsBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('authors', $this);
    }

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
