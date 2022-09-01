<?php

namespace App\Controllers;

use App\Blocks\BooksBlock;

class BooksController implements ControllerInterface
{
    public function execute()
    {
        $block = new BooksBlock();
        $block->render();
    }
}
