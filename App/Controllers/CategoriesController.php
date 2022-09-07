<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;

class CategoriesController implements ControllerInterface
{
    public function execute()
    {
        $block = new CategoriesBlock();
        $block ->setData();
        $block->render();
    }
}
