<?php

namespace App\Blocks;

class HomePageBlock implements BlocksInterface
{

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('homepage', $this);
    }

    public function getData(): array
    {
        return [''];
    }
}