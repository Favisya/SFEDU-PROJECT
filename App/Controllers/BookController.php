<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Blocks\BookBlock;
use App\Models\Resource\BookResource;
use App\Models\SessionModel;
use Laminas\Di\Di;

class BookController extends AbstractController
{
    public function execute()
    {
        $bookResource = $this->resource;
        $bookModel = $bookResource->getBook($this->getParam('id'));

        $this->renderPage('book', $bookModel, $this->block);
    }
}
