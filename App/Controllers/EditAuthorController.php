<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class EditAuthorController extends AbstractController
{
    public function execute()
    {
        $this->setToken();
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->getAuthor($this->getParam('id'));

        $this->commonExecute('createAuthor', $authorModel);
    }
}
