<?php

namespace App\Controllers;

use App\Blocks\LibrariesBlock;

class LibrariesController implements ControllerInterface
{
    public function execute()
    {
        $block = new LibrariesBlock();
        $block->render();
    }
}
