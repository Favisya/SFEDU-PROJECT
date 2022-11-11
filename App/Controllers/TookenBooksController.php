<?php

namespace App\Controllers;

use App\Blocks\BooksBlock;
use App\Models\Resource\BooksResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class TookenBooksController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BooksBlock $block,
        BooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $session    = $this->session;
        $booksModel = $this->resource->getTookenBooks($session->getUserId());
        $this->renderPage('tookenBooks', $this->block, $booksModel);
    }
}
