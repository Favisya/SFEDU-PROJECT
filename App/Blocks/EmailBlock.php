<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class EmailBlock extends UserBlock
{
    public function render()
    {
        require_once APP_ROOT . '/App/templates/' . $this->template . '.phtml';
    }
}
