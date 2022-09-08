<?php

namespace App\Controllers;

use App\Blocks\LibraryBlock;

class LibraryController implements ControllerInterface
{
    public function execute()
    {
        $block = new LibraryBlock();
        $block->setData($_GET['id']);
        $block->setBooks($_GET['id']);
        $block->render();
    }
}
