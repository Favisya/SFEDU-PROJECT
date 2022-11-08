<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class PostEditAuthorController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['authorName']);

        $authorResource = $this->di->get(AuthorResource::class);
        $authorModel = $authorResource->editAuthor(
            $this->getPostParam('authorName'),
            $this->getParam('id')
        );
        $this->redirect('author?id=' . $authorModel->getList()['id']);
    }
}
