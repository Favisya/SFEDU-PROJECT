<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class PostCreateLibraryController extends AbstractController
{
    public function execute()
    {
        $LibraryResource = new LibraryResource();
        $libraryModel = $LibraryResource->createLibrary($_POST['libName'], $_POST['libAddress']);
        $this->redirect('library?id=' . $libraryModel->getData()['id']);
    }
}
