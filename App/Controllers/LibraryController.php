<?php

namespace App\Controllers;

use App\Blocks\LibraryBlock;

class LibraryController implements ControllerInterface
{
    public function execute()
    {
        $block = new LibraryBlock();
        $block->render();
    }
}
