<?php

namespace App\Controllers;

use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractController
{
    public function execute()
    {
        $authorsResource = new AuthorsResource();
        $authorsModel = $authorsResource->getAuthors();

        $this->renderPage('authors', $authorsModel, 'AuthorsBlock');
    }
}
