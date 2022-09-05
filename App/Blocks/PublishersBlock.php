<?php

namespace App\Blocks;

class PublishersBlock extends BlocksAbstract
{
    protected $template = 'publishers';

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
