<?php

namespace App\Blocks;

class FooterBlock implements BlocksInterface
{
    public function render()
    {
        require_once APP_ROOT . "/App/templates/footerTemplate.phtml";
    }

    public function getData(): array
    {
        return [''];
    }
}