<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Blocks\LibraryBlock;
use App\Models\LibraryModel;
use App\Models\Resource\BookResource;
use Laminas\Di\Di;

class CreateLibraryController extends AbstractController
{
    public function __construct(Di $di, BookResource $resource, LibraryBlock $block, LibraryModel $model)
    {
        parent::__construct($di, $resource, $block, $model);
    }

    public function execute()
    {
        $this->renderPage('createLibrary', $this->model, $this->block);
    }
}
