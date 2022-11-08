<?php

namespace App\Controllers;

use App\Blocks\AuthorsBlock;
use App\Models\Resource\AuthorsResource;
use Laminas\Di\Di;

class AuthorsController extends AbstractController
{


    public function execute()
    {
        $authorsResource = $this->resource;
        $authorsModel = $authorsResource->getAuthors();

        $this->renderPage('authors', $authorsModel, $this->block);
    }
}
