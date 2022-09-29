<?php

namespace App\Controllers;

use App\Blocks\FormBlock;
use App\Models\Resource\CreateBookResource;

class CreateBookController extends AbstractController
{
    public function execute()
    {
        $this->setToken();
        $resource = new CreateBookResource();
        $block = new FormBlock();
        $block->setTemplate('createBook');

        $models = $resource->getBookInfo();

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
