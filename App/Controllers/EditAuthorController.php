<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class EditAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = $this->di->get(AuthorResource::class);
        $authorModel = $authorResource->getAuthor($this->getParam('id'));

        $this->renderPage('createAuthor', $authorModel, 'AuthorBlock');
    }
}
