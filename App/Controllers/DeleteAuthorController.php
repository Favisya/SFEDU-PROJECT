<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class DeleteAuthorController extends AbstractController
{
    public function execute()
    {
        $resource = new AuthorResource();
        $resource->deleteAuthor($_GET['id']);
        $this->redirect('authors');
    }
}