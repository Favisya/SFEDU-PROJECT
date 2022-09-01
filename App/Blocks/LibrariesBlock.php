<?php

namespace App\Blocks;

class LibrariesBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/libraries/libraries.phtml';
    }

    public function getData(): array
    {
        $data = [
            'библиотека имени Чехова1',
            'библиотека имени Чехова2',
            'библиотека имени Чехова3',
            'библиотека имени Чехова4',
        ];

        return $data;
    }
}
