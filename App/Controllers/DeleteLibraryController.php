<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class DeleteLibraryController extends AbstractController
{
    public function execute()
    {
        $resource = new LibraryResource();
        $resource->deleteLibrary($_GET['id']);
        $this->redirect('libraries');
    }
}