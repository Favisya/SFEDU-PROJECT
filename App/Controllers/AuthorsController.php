<?php

namespace App\Controllers;

use App\Blocks\AuthorsBlock;
use App\Models\Resource\AuthorsResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class AuthorsController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AuthorsBlock $block,
        AuthorsResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $AuthorResource = $this->resource;
        $authorsModel = $AuthorResource->getAuthors();

        $this->renderPage('authors', $this->block, $authorsModel);
    }
}
