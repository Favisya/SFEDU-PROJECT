<?php

namespace App\Controllers;

use App\Blocks\BooksBlock;
use App\Blocks\BookBlock;

class BooksController implements ControllerInterface
{
    public function execute()
    {
        $block = new BooksBlock();
        $block->render();
    }
}
