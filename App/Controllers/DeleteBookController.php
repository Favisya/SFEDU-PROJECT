<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;

class DeleteBookController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(BookResource::class);
        $resource->deleteBook($this->getParam('id'));
        $this->redirect('books');
    }
}
