<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CategoriesModel;

class CategoriesController implements ControllerInterface
{
    public function execute()
    {
        $model = new CategoriesModel();
        $model ->setData();

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('categories');
        $block->render();
    }
}
