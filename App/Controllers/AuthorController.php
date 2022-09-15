<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorModel;
use App\Models\Resource\AuthorResource;

class AuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();

        $authorModel = $authorResource->executeQuery($_GET['id']);

        $this->commonExecute('author', $authorModel);
    }
}
