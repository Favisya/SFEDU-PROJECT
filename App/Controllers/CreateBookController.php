<?php

namespace App\Controllers;

use App\Blocks\AuthorsBlock;
use App\Blocks\CreateBookBlock;
use App\Models\AuthorModel;
use App\Models\Resource\BookResource;
use Laminas\Di\Di;

class CreateBookController extends AbstractController
{
    public function __construct(Di $di, BookResource $resource, CreateBookBlock $block)
    {
        parent::__construct($di, $resource, $block);
    }

    public function execute()
    {

        $this->block->setTemplate('createBook');

        $models = $this->resource->getBookInfo();

        $this->handleModels($models, $this->block);

        $this->block->render();
    }
}
