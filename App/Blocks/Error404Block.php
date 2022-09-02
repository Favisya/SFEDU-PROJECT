<?php

namespace App\Blocks;

class Error404Block implements BlocksInterface
{

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
        renderPage('404', $this);
    }

    public function getData(): array
    {
        return [''];
    }
}