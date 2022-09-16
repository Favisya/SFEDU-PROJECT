<?php

namespace App\Controllers;

use App\Blocks\Block;

class HomePageController extends AbstractController
{
    public function execute()
    {
        $this->commonExecute('homepage');
    }
}
