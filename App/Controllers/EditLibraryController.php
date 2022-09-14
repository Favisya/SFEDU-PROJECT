<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;
use App\Models\Resource\LibraryResource;

class EditLibraryController extends AbstractController
{
    public function execute()
    {
        $libraryResource = new LibraryResource();
        if ($this->isGetMethod()) {
            $block = new Block();
            $libraryModel = new LibraryModel();

            $data = $libraryResource->executeQuery($_GET['id']);
            $libraryModel->setData($data['info']);

            $this->commonExecute('createLibrary', $libraryModel);
        } else {
            $libraryResource->editLibrary($_POST['libName'], $_POST['libAddress'], $_GET['id']);
        }
    }
}
