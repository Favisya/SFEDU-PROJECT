<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;
use App\Models\Resource\AuthorResource;

class EditAuthorController extends AbstractController
{
    public function execute()
    {
        $authorResource = new AuthorResource();
        $authorModel = new AuthorModel();

        $data = $authorResource->executeQuery($_GET['id']);
        $authorModel->setData($data['info']);

        $this->commonExecute('createAuthor', $authorModel);
    }
}
