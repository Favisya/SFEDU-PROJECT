<?php

namespace App\Blocks;

class HeaderBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . "/App/templates/headerTemplate.phtml";
    }

    public function getData(): array
    {
        return [''];
    }
}