<?php

namespace App\Controllers;

use App\Blocks\Block;

class HomePageController implements ControllerInterface
{
    public function execute()
    {
        $block = new Block();
        $block->setTemplate('homepage');
        $block->render();
    }
}
