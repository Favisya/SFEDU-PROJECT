<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;
use App\Models\SessionModel;

class TookenBooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new BooksResource();
        $booksModel = $booksResource->getTookenBooks(SessionModel::getInstance()->getUserId());

        $this->commonExecute('tookenBooks', $booksModel);
    }
}
