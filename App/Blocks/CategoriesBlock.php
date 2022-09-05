<?php

namespace App\Blocks;

class CategoriesBlock extends BlocksAbstract
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
