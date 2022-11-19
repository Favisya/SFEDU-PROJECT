<?php

namespace App\Books\Controllers;

use App\Core\Controllers\AbstractController;

class CreateLibraryController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('createLibrary', $this->block, $this->model);
    }
}
