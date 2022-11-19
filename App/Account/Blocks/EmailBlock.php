<?php

namespace App\Account\Blocks;

class EmailBlock extends UserBlock
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/' . $this->template . '.phtml';
    }
}
