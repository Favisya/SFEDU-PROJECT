<?php

namespace App\Controllers;

class Error404Controller extends AbstractController
{
    public function execute()
    {
        $this->commonExecute('404');
    }
}
