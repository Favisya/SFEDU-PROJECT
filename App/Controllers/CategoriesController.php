<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class CategoriesController extends AbstractController
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
        $categoriesResource = $this->resource;
        $categoriesModel = $categoriesResource->getCategories();

        $this->renderPage('categories', $this->block, $categoriesModel);
    }
}
