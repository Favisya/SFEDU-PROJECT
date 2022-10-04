<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;

class BookController extends AbstractController
{
    public function execute()
    {
        $bookResource = new BookResource();
        $bookModel = $bookResource->getBook($this->getParam('id'));

        $this->commonExecute('book', $bookModel, 'BookBlock');
    }
}
