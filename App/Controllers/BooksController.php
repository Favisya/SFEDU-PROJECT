<?php

namespace App\Controllers;

use App\Blocks\BooksBlock;
use App\Models\Resource\BooksResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class BooksController extends AbstractController
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
        $booksResource = $this->resource;
        $booksModel = $booksResource->getBooks($this->getParam('id') ?? 0);

        $this->renderPage('books', $this->block, $booksModel);
    }
}
