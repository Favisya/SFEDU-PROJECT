<?php

namespace App\Blocks;

class PublishersBlock extends BlocksAbstract
{
    protected $fileToRender = APP_ROOT . '/App/View/publishers.phtml';

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
