<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Blocks\CategoriesBlock;
use App\Models\Resource\CategoriesResource;
use App\Models\SessionModel;
use Laminas\Di\Di;

class CategoriesController extends AbstractController
{
    public function __construct(Di $di, CategoriesResource $resource, CategoriesBlock $block)
    {
        parent::__construct($di, $resource, $block);
    }

    public function execute()
    {
        $categoriesResource = $this->resource;
        $categoriesModel = $categoriesResource->getCategories();

        $this->renderPage('categories', $categoriesModel, $this->block);
    }
}
