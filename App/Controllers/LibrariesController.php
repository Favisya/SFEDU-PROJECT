<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibrariesModel;

class LibrariesController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibrariesModel();
        $model->setData();

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('libraries');
        $block->render();
    }
}
