<?php

namespace App\Books\Controllers;

use App\Books\Blocks\BookBlock;
use App\Books\Models\Resource\BooksResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;
use App\Core\Controllers\AbstractController;

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
