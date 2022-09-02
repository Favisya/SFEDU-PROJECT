<?php

namespace App\Blocks;

class CategoriesBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('categories', $this);
    }

    public function getData(): array
    {
        return [
            'худ литература1',
            'худ литература2',
            'худ литература3',
            'худ литература4',
        ];

        return $data;
    }
}
