<?php

namespace App\Controllers;

class CreateAuthorController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('createAuthor', $this->block, $this->model);
    }
}
