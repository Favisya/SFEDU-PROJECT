<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BookModel;
use App\Models\Resource\BookResource;

class BookController extends AbstractController
{
    public function execute()
    {
        $bookModel = new BookModel();
        $bookResource = new BookResource();

        $data = $bookResource->executeQuery($_GET['id']);

        $bookModel->setData($data['info']);
        $bookModel->setLibs($data['books']);

        $this->commonExecute('book', $bookModel);
    }
}
