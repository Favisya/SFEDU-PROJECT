<?php

namespace App\Controllers;

use App\Models\Resource\BookResource;
use App\Models\SessionModel;

class TakeBookController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(BookResource::class);
        $session = $this->di->get(SessionModel::class);
        $resource->takeBook($this->getParam('id'), $session->getUserId());
        $this->redirect('books');
    }
}
