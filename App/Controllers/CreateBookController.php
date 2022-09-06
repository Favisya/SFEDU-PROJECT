<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;

class CreateBookController implements ControllerInterface
{

    public function execute()
    {
        $block = new CreateBookBlock();
        $block->render();
    }
}