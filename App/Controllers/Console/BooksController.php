<?php

namespace App\Controllers\Console;

class BooksController extends AbstractController
{
    public function execute()
    {
        $resource = new \App\Models\Resource\BooksResource();
        $model = $resource->getBooks();
        $this->printToFile($model);
    }
}
