<?php

namespace App\Controllers;

use App\Blocks\Block;

class Error404Controller extends AbstractController
{
    public function execute()
    {
        $this->commonExecute('404');
    }
}
