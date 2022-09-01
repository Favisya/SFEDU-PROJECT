<?php

namespace App\Controllers;

use App\Blocks\PublishersBlock;

class PublishersController implements ControllerInterface
{
    public function execute()
    {
        $block = new PublishersBlock();
        $block->render();
    }
}
