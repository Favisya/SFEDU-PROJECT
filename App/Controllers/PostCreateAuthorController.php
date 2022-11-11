<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\AuthorResource;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostCreateAuthorController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AuthorResource $resource
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
