<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class PostEditLibraryController extends AbstractController
{
    public function execute()
    {
        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->editLibrary($_POST['libName'], $_POST['libAddress'], $_GET['id']);
        $this->redirect('library?id=' . $libraryModel->getData()['id']);
    }
}
