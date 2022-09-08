<?php

namespace App\Blocks;

abstract class BlockAbstract
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [''];
    }

}
