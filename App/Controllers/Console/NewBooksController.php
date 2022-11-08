<?php

namespace App\Controllers\Console;

use App\Models\Resource\UpdateBooksResource;
use GuzzleHttp;

class NewBooksController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(UpdateBooksResource::class);
        $resource->parseNewBooks();
    }
}
