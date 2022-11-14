<?php

namespace App\Controllers;

use App\Models\Resource\BooksResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class DeleteBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->resource->deleteBook($this->getParam('id'));
        $this->redirect('books');
    }
}
