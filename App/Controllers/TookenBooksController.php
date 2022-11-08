<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;
use App\Models\SessionModel;

class TookenBooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = $this->di->get(BooksResource::class);
        $session       = $this->di->get(SessionModel::class);
        $booksModel = $booksResource->getTookenBooks($session->getUserId());

        $this->renderPage('tookenBooks', $booksModel, 'BooksBlock');
    }
}
