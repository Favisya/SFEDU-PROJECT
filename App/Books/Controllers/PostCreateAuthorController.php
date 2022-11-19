<?php

namespace App\Books\Controllers;

use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\AuthorsResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class PostCreateAuthorController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AuthorsResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $authorResource = $this->resource;
        $this->handleToken();

        $this->validateForm(['authorName']);

        $authorModel = $authorResource->createAuthor($this->getPostParam('authorName'));
        $this->redirect('author?id=' . $authorModel->getList()['id']);
    }
}
