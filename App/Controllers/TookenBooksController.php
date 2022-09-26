<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;

class TookenBooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new BooksResource();
        $booksModel = $booksResource->getTookenBooks($_SESSION['id']);

        $this->commonExecute('tookenBooks', $booksModel);
    }
}
