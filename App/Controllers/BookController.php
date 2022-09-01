<?php

namespace App\Controllers;

use App\Blocks\BookBlock;

class BookController implements ControllerInterface
{
    public function execute()
    {
        $block = new BookBlock();
        $block->render();
    }
}
