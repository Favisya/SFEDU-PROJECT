<?php

namespace App\Blocks;

class CategoriesBlock implements BlocksInterface
{
    public function render()
    {
        require APP_ROOT . '/App/View/categories/categories.phtml';
    }

    public function getData(): array
    {
        $data = [
            'худ литература1',
            'худ литература2',
            'худ литература3',
            'худ литература4',
        ];

        return $data;
    }
}
