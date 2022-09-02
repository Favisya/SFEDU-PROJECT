<?php

namespace App\Controllers;

use App\Blocks\Error404Block;

class Error404Controller implements ControllerInterface
{
    public function execute()
    {
        $block = new Error404Block();
        $block->render();
    }
}
