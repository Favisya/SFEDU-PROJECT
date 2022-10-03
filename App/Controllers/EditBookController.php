<?php

namespace App\Controllers;

use App\Blocks\FormBlock;
use App\Models\Resource\BookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $block = new FormBlock();
        $block->setTemplate('createBook');

        $models = $resource->getBookInfo($this->getParam('id'));

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
