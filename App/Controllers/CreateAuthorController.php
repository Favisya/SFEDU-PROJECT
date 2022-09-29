<?php

namespace App\Controllers;

use App\Models\AuthorModel;

class CreateAuthorController extends AbstractController
{
    public function execute()
    {
        $this->setToken();
        $authorModel = new AuthorModel();
        $this->commonExecute('createAuthor', $authorModel);
    }
}
