<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;

class DeleteBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $resource->deleteBook($this->getParam('id'));
        $this->redirect('books');
    }
}
