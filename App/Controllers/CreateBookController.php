<?php

namespace App\Controllers;

use App\Blocks\BookBlock;
use App\Blocks\CreateBookBlock;
use App\Models\Resource\BookResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class CreateBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        CreateBookBlock $block,
        BookResource $resource
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
