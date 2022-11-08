<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class DeleteAuthorController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(AuthorResource::class);
        $resource->deleteAuthor($this->getParam('id'));
        $this->redirect('authors');
    }
}
