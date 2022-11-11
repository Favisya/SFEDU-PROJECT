<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\BookResource;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class TakeBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BookResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $session = $this->session;
        $this->resource->takeBook($this->getParam('id'), $session->getUserId());
        $this->redirect('books');
    }
}
