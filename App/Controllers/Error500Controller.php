<?php

namespace App\Controllers;

use App\Blocks\Block;

class Error500Controller extends AbstractController
{
    public function execute()
    {
        $this->commonExecute('500');
    }
}
