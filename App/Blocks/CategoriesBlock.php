<?php

namespace App\Blocks;

class CategoriesBlock extends BlockAbstract
{
    protected $template = 'categories';

    public function getData(): array
    {
        return [
            'худ литература1',
            'худ литература2',
            'худ литература3',
            'худ литература4',
        ];
    }
}
