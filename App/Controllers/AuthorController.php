<?php

namespace App\Controllers;

use App\Blocks\AuthorBlock;
use App\Blocks\AuthorsBlock;

class AuthorController implements ControllerInterface
{
    public function execute()
    {
        $block = new AuthorBlock();
        $block->render();
    }
}
