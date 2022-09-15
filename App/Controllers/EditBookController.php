<?php

namespace App\Controllers;

use App\Blocks\BookFormBlock;
use App\Models\Resource\EditBookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = new EditBookResource();
        $block = new BookFormBlock();
        $block->setTemplate('createBook');

        $models = $resource->executeQuery($_GET['id']);

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
