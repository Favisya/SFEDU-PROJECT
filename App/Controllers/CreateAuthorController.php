<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;
use App\Models\Resource\AuthorResource;

class CreateAuthorController extends AbstractController
{
    public function execute()
    {
        if ($this->isGetMethod()) {
            $authorModel = new AuthorModel();

            $this->commonExecute('createAuthor', $authorModel);
        } else {
            $authorResource = new AuthorResource();
            $authorResource->createAuthor($_POST['authorName']);
        }
    }
}
