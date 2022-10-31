<?php

namespace App\Controllers\Console;

use App\Models\Service;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new \App\Models\Resource\BooksResource();
        $resource = new Service();
        $model = $booksResource->getBooks();
        $arguments = $this->getArgument();
        $resource->printToFile($model, reset($arguments));
    }
}
