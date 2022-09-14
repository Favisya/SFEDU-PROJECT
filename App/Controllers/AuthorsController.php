<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorsModel;
use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractController
{
    public function execute()
    {
        $authorsModel = new AuthorsModel();
        $authorsResource = new AuthorsResource();

        $data = $authorsResource->executeQuery();
        $authorsModel->setData($data);

        $this->commonExecute('authors', $authorsModel);
    }
}
