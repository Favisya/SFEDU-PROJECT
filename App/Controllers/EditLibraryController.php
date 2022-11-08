<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class EditLibraryController extends AbstractController
{
    public function execute()
    {
        $libraryResource = $this->di->get(LibraryResource::class);
        $libraryModel = $libraryResource->getLibrary($this->getParam('id'));

        $this->renderPage('createLibrary', $libraryModel, 'LibraryBlock');
    }
}
