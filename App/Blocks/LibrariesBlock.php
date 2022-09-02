<?php

namespace App\Blocks;

class LibrariesBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('libraries', $this);
    }

    public function getData(): array
    {
        return [
            'библиотека имени Чехова1',
            'библиотека имени Чехова2',
            'библиотека имени Чехова3',
            'библиотека имени Чехова4',
        ];
    }
}
