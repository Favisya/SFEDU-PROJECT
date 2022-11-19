<?php

namespace App\Books\Controllers;

use App\Core\Controllers\AbstractController;

class CreateAuthorController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('createAuthor', $this->block, $this->model);
    }
}
