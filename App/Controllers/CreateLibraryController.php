<?php

namespace App\Controllers;

use App\Models\LibraryModel;

class CreateLibraryController extends AbstractController
{
    public function execute()
    {
        $this->setToken();
        $libraryModel = new LibraryModel();
        $this->commonExecute('createLibrary', $libraryModel);
    }
}
