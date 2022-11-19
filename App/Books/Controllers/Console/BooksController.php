<?php

namespace App\Books\Controllers\Console;

use App\Core\Controllers\Console\AbstractController;
use App\Books\Models\Resource\BooksResource;
use App\Core\Models\Service;

class BooksController extends AbstractController
{
    protected $service;
    private $booksResource;

    public function __construct(Service $service, BooksResource $booksResource)
    {
        $this->booksResource = $booksResource;
        $this->service = $service;
    }

    public function execute()
    {
        $model = $this->booksResource->getBooks();
        $arguments = $this->getArguments();
        $this->service->printToFile($model, reset($arguments));
    }
}
