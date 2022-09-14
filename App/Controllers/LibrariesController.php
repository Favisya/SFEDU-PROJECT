<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibrariesModel;

class LibrariesController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibrariesModel();
        $data = $model->executeQuery();
        $model->setData($data);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('libraries');
        $block->render();
    }
}
