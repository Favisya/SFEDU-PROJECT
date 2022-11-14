<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Models\Resource\BooksResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class EditBookController extends AbstractController
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
        $models = $this->resource->getBookInfo($this->getParam('id'));
        $this->handleModels($models, $this->block);
        $this->block->render();
    }
}
