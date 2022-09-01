<?php

namespace App\Controllers;

use App\Blocks\AuthorsBlock;

class AuthorsController implements ControllerInterface
{
    public function execute()
    {
        $block = new AuthorsBlock();
        $block->render();
    }
}
