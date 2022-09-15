<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class PostCreateAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->createAuthor($_POST['authorName']);
        $this->redirect('author?id=' . $authorModel->getData()['id']);
    }
}
