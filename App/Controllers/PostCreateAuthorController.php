<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class PostCreateAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();
        $authorResource->createAuthor($_POST['authorName']);
    }
}
