<?php

namespace App\Controllers;

use App\Blocks\BookBlock;
use App\Blocks\CreateBookBlock;
use App\Models\Resource\BookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(BookResource::class);
        $block = $this->di->get(CreateBookBlock::class);
        $block->setTemplate('createBook');

        $models = $resource->getBookInfo($this->getParam('id'));

        $this->handleModels($models, $block);

        $block->render();
    }
}
