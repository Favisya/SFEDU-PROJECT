<?php

namespace App\Controllers\Console;

use App\Models\Resource\BooksResource;
use App\Models\Service;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new BooksResource();
        $service = new Service();
        $model = $booksResource->getBooks();
        $arguments = $this->getArguments();
        $service->printToFile($model, reset($arguments));
    }
}
