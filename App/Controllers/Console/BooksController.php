<?php

namespace App\Controllers\Console;

use App\Models\Resource\BooksResource;
use App\Models\Service;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = $this->di->get(BooksResource::class);
        $service = $this->di->get(Service::class);
        $model = $booksResource->getBooks();
        $arguments = $this->getArguments();
        $service->printToFile($model, reset($arguments));
    }
}
