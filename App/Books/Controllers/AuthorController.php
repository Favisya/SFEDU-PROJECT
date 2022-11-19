<?php

namespace App\Books\Controllers;

use App\Books\Blocks\AuthorBlock;
use App\Books\Models\Resource\AuthorsResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;
use App\Core\Controllers\AbstractController;

class AuthorController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AuthorBlock $block,
        AuthorsResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $authorResource = $this->resource;
        $authorModel = $authorResource->getAuthor($this->getParam('id'));

        $this->renderPage('author', $this->block, $authorModel);
    }
}
