<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BookModel;
use App\Models\Resource\BookResource;

class BookController extends AbstractController
{
    public function execute()
    {
        $bookResource = new BookResource();
        $bookModel = $bookResource->executeQuery($_GET['id']);

        $this->commonExecute('book', $bookModel);
    }
}
