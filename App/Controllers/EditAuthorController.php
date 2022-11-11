<?php

namespace App\Controllers;

use App\Blocks\AuthorBlock;
use App\Models\Resource\AuthorResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class EditAuthorController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AuthorBlock $block,
        AuthorResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $authorModel = $this->resource->getAuthor($this->getParam('id'));

        $this->renderPage('createAuthor', $this->block, $authorModel);
    }
}
