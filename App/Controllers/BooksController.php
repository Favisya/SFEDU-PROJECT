<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BooksModel;
use App\Models\Resource\BooksResource;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksModel = new BooksModel();
        $booksResource = new BooksResource();

        $data = $booksResource->executeQuery($_GET['author_id'] ?? 0);
        $booksModel->setData($data);

        $this->commonExecute('books', $booksModel);
    }
}
