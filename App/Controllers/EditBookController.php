<?php

namespace App\Controllers;

use App\Blocks\FormBlock;
use App\Models\Resource\EditBookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = new EditBookResource();
        $block = new FormBlock();
        $block->setTemplate('createBook');

        $models = $resource->executeQuery($this->getParam('id'));

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
