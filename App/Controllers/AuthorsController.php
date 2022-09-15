<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorsModel;
use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractController
{
    public function execute()
    {
        $authorsResource = new AuthorsResource();
        $authorsModel = $authorsResource->executeQuery();

        $this->commonExecute('authors', $authorsModel);
    }
}
