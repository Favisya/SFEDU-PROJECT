<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class PostEditLibraryController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $this->validateForm('libName');
        $this->validateForm('libAddress');

        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->editLibrary(
            $this->getPostParam('libName'),
            $this->getPostParam('libAddress'),
            $this->getParam('id')
        );
        $this->redirect('library?id=' . $libraryModel->getData()['id']);
    }
}
