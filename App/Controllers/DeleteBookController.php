<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;
use App\Models\Resource\LibraryResource;

class DeleteBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $resource->deleteBook($_GET['id']);
        $this->redirect('books');
    }
}