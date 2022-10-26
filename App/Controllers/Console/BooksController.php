<?php

namespace App\Controllers\Console;

use App\Models\Resource\ConsoleService;

class BooksController extends AbstractController
{
    public function execute()
    {
        $booksResource = new \App\Models\Resource\BooksResource();
        $consoleResource = new ConsoleService();
        $model = $booksResource->getBooks();
        $consoleResource->printToFile($model, $this->getArgument());
    }
}
