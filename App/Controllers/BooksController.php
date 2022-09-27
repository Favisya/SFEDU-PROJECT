<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new BooksResource();
        $booksModel = $booksResource->getBooks($_GET['author_id'] ?? 0);

        $this->commonExecute('books', $booksModel);
    }
}
