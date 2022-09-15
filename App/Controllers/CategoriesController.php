<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CategoriesModel;
use App\Models\Resource\CategoriesResource;

class CategoriesController extends AbstractController
{
    public function execute()
    {
        $categoriesResource = new CategoriesResource();
        $categoriesModel = $categoriesResource->executeQuery();

        $this->commonExecute('categories', $categoriesModel);
    }
}
