<?php

namespace App\Controllers;

use App\Models\Resource\AuthorResource;

class PostEditAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();
        $authorResource->editAuthor($_POST['authorName'], $_GET['id']);
    }
}
