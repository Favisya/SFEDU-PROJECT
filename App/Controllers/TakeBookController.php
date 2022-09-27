<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;
use App\Models\SessionModel;

class TakeBookController extends AbstractController
{
    public function execute()
    {
        $resource = new BookResource();
        $resource->takeBook($this->getParam('id'), SessionModel::getInstance()->getUserId());
        $this->redirect('books');
    }
}
