<?php

namespace App\Books\Controllers;

use App\Books\Blocks\AuthorsBlock;
use App\Books\Models\Resource\AuthorsResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

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
