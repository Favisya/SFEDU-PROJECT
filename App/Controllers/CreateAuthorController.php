<?php

namespace App\Controllers;

use App\Models\AuthorModel;

class CreateAuthorController extends AbstractController
{
    public function execute()
    {
        $authorModel = new AuthorModel();
        $this->commonExecute('createAuthor', $authorModel);
    }
}
