<?php

namespace App\Controllers;

use App\Blocks\BookFormBlock;
use App\Models\Resource\CreateBookResource;

class CreateBookController extends AbstractController
{
    public function execute()
    {
        $resource = new CreateBookResource();
        $block = new BookFormBlock();
        $block->setTemplate('createBook');

        $models = $resource->executeQuery();

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
