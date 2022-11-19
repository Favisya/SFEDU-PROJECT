<?php

namespace App\Books\Controllers;

use App\Books\Blocks\AuthorBlock;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\AuthorsResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class EditAuthorController extends AbstractController
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
        $authorModel = $this->resource->getAuthor($this->getParam('id'));

        $this->renderPage('createAuthor', $this->block, $authorModel);
    }
}
