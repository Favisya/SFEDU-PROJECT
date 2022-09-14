<?php

namespace App\Controllers;

use App\Blocks\Block;

class Error500Controller implements ControllerInterface
{
    public function execute()
    {
        $block = new Block();
        $block->setTemplate('500');
        $block->render();
    }
}
