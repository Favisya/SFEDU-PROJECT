<?php

namespace App\Controllers;

use App\Models\Resource\LibraryResource;

class DeleteLibraryController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(LibraryResource::class);
        $resource->deleteLibrary($this->getParam('id'));
        $this->redirect('libraries');
    }
}
