<?php

namespace App\Controllers\Console;

use App\Models\Resource\Service;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new \App\Models\Resource\BooksResource();
        $Resource = new Service();
        $model = $booksResource->getBooks();
        $Resource->printToFile($model, $this->getArgument());
    }
}
