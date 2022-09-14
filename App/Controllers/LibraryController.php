<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;
use App\Models\Resource\LibraryResource;

class LibraryController extends AbstractController
{
    public function execute()
    {
        $libraryModel = new LibraryModel();
        $libraryResource = new LibraryResource();

        $data = $libraryResource->executeQuery($_GET['id']);

        $libraryModel->setData($data['info']);
        $libraryModel->setBooks($data['books']);

        $this->commonExecute('library', $libraryModel);
    }
}
