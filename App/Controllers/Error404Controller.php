<?php

namespace App\Controllers;

use App\Blocks\Block;

class Error404Controller implements ControllerInterface
{
    public function execute()
    {
        $block = new Block();
        $block->setTemplate('404');
        $block->render();
    }
}
