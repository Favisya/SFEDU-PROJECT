<?php

namespace App\Books\Controllers;

use App\Books\Blocks\CategoriesBlock;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\CategoriesResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class PublishersController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        CategoriesBlock $block,
        CategoriesResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $publishersResource = $this->resource;
        $publishersModel = $publishersResource->getPublishers();

        $this->renderPage('publishers', $this->block, $publishersModel);
    }
}
