<?php

namespace App\Account\Controllers;

use App\Account\Blocks\BooksBlock;
use App\Account\Models\Resource\ClientsBooksResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class TookenBooksController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BooksBlock $block,
        ClientsBooksResource $resource
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
