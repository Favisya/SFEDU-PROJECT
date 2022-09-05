<?php

namespace App\Blocks;

class LibrariesBlock extends BlocksAbstract
{
    protected $template = 'libraries';

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
