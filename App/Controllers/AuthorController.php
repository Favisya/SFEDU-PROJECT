<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorModel;
use App\Models\Resource\AuthorResource;

class AuthorController extends AbstractController
{
    public function execute()
    {
        $authorModel = new AuthorModel();
        $authorResource = new AuthorResource();

        $data = $authorResource->executeQuery($_GET['id']);

        $authorModel->setData($data['info']);
        $authorModel->setBooks($data['books']);

        $this->commonExecute('author', $authorModel);
    }
}
