<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class AuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();

        $authorModel = $authorResource->getAuthor($this->getParam('id'));

        $this->commonExecute('author', $authorModel, 'AuthorBlock');
    }
}
