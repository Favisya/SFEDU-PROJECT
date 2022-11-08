<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Blocks\BooksBlock;
use App\Models\Resource\BooksResource;
use App\Models\SessionModel;
use Laminas\Di\Di;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = $this->resource;
        $booksModel = $booksResource->getBooks($this->getParam('id') ?? 0);

        $this->renderPage('books', $booksModel, $this->block);
    }
}
