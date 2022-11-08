<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\AuthorResource;

class PostCreateAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = $this->di->get(AuthorResource::class);
        $this->handleToken();

        $this->validateForm(['authorName']);

        $authorModel = $authorResource->createAuthor($this->getPostParam('authorName'));
        $this->redirect('author?id=' . $authorModel->getList()['id']);
    }
}
