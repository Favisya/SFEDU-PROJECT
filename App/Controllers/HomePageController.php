<?php

namespace App\Controllers;

use App\Blocks\HomePageBlock;

class HomePageController implements ControllerInterface
{

    public function execute()
    {
        $block = new HomePageBlock();
        $block->render();
    }
}