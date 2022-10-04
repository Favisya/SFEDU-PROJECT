<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Models\Resource\BookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $block = new CreateBookBlock();
        $block->setTemplate('createBook');

        $models = $resource->getBookInfo($this->getParam('id'));

        $this->handleModels($models, $block);

        $block->render();
    }
}
