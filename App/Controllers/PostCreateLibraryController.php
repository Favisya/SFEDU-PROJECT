<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class PostCreateLibraryController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $LibraryResource = new LibraryResource();
        $libraryModel = $LibraryResource->createLibrary(
            $this->getPostParam('libName'),
            $this->getPostParam('libAddress')
        );

        $this->redirect('library?id=' . $libraryModel->getData()['id']);
    }
}
