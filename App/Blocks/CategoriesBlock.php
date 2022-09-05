<?php

namespace App\Blocks;

class CategoriesBlock extends BlocksAbstract
{
    protected $template = APP_ROOT . '/App/View/categories.phtml';

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
