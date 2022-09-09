<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\PublishersModel;

class PublishersController implements ControllerInterface
{
    public function execute()
    {
        $model = new PublishersModel();
        $model->setData();

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('publishers');
        $block->render();
    }
}
