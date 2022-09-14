<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;
use App\Models\Resource\LibraryResource;

class CreateLibraryController extends AbstractController
{
    public function execute()
    {
        if ($this->isGetMethod()) {
            $block = new Block();
            $libraryModel = new LibraryModel();

            $this->commonExecute('createLibrary', $libraryModel);
        } else {
            $LibraryResource = new LibraryResource();
            $LibraryResource->createLibrary($_POST['libName'], $_POST['libAddress']);
        }
    }
}
