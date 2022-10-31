<?php

namespace App\Controllers;

use App\Models\LibraryModel;

class CreateLibraryController extends AbstractController
{
    public function execute()
    {
        $libraryModel = new LibraryModel();
        $this->renderPage('createLibrary', $libraryModel, 'LibraryBlock');
    }
}
