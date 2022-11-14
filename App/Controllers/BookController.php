<?php

namespace App\Controllers;

use App\Blocks\BookBlock;
use App\Models\Resource\BooksResource;
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
        BooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $BooksResource = $this->resource;
        $bookModel = $BooksResource->getBook($this->getParam('id'));

        $this->renderPage('book', $this->block, $bookModel);
    }
}
