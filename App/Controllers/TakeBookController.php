<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;

class TakeBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $resource->takeBook($_GET['id'], $_SESSION['id']);
        $this->redirect('books');
    }
}
