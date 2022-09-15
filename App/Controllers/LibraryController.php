<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class LibraryController extends AbstractController
{
    public function execute()
    {
        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->executeQuery($_GET['id']);

        $this->commonExecute('library', $libraryModel);
    }
}
