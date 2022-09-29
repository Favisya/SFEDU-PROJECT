<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class PostEditAuthorController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->editAuthor(
            $this->getPostParam('authorName'),
            $this->getParam('id')
        );
        $this->redirect('author?id=' . $authorModel->getData()['id']);
    }
}
