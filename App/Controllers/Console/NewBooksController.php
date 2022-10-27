<?php

namespace App\Controllers\Console;

use App\Models\Resource\UpdateBooksResource;
use GuzzleHttp;

class NewBooksController extends AbstractController
{
    public function execute()
    {
        $resource = new UpdateBooksResource();
        $resource->parseNewBooks();
    }
}
