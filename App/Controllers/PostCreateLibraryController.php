<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class PostCreateLibraryController extends AbstractController
{
    public function execute()
    {
        $LibraryResource = new LibraryResource();
        $LibraryResource->createLibrary($_POST['libName'], $_POST['libAddress']);
    }
}
