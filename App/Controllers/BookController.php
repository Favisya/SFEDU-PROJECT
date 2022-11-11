<?php

namespace App\Controllers;

use App\Blocks\BookBlock;
use App\Models\Resource\BookResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class BookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BookBlock $block,
        BookResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $bookResource = $this->resource;
        $bookModel = $bookResource->getBook($this->getParam('id'));

        $this->renderPage('book', $this->block, $bookModel);
    }
}
