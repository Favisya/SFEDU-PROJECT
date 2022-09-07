<?php

namespace App\Controllers;

use App\Blocks\BookBlock;

class BookController implements ControllerInterface
{
    public function execute()
    {
        $block = new BookBlock();
        $block->setData($_GET['id']);
        $block->setLibs($_GET['id']);
        $block->render();
    }
}
