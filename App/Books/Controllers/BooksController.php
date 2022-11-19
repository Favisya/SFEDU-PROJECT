<?php

namespace App\Books\Controllers;

use App\Books\Blocks\BooksBlock;
use App\Books\Models\Resource\BooksResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;
use App\Core\Controllers\AbstractController;

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
