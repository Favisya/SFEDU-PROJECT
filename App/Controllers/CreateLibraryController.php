<?php

namespace App\Controllers;

class CreateLibraryController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('createLibrary', $this->block, $this->model);
    }
}
