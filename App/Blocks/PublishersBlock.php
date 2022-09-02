<?php

namespace App\Blocks;

class PublishersBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('publishers', $this);
    }

    public function getData(): array
    {
        return [
            'Эскма',
            'Приколы',
            'фывфыв',
            'Приколыв 12321',
        ];
    }
}
