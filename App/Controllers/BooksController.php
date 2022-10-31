<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new BooksResource();
        $booksModel = $booksResource->getBooks($this->getParam('id') ?? 0);

        $this->renderPage('books', $booksModel, 'BooksBlock');
    }
}
