<?php

namespace App\Controllers\Console;

use App\Blocks\AbstractBlock;
use App\Models\AbstractModel;
use App\Models\AbstractService;
use App\Models\Resource\AbstractResource;
use App\Models\Resource\BooksResource;
use App\Models\Resource\Environment;
use App\Models\Service;
use App\Models\SessionModel;
use App\Models\TokenModel;

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
