<?php

namespace App\Books\Controllers;

use App\Books\Blocks\CreateBookBlock;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\BooksResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class CreateBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        CreateBookBlock $block,
        BooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $this->block->setTemplate('createBook');

        $models = $this->resource->getBookInfo();

        $this->handleModels($models, $this->block);

        $this->block->render();
    }
}
