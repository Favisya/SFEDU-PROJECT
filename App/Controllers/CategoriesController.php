<?php

namespace App\Controllers;

use App\Models\Resource\CategoriesResource;

class CategoriesController extends AbstractController
{
    public function execute()
    {
        $categoriesResource = new CategoriesResource();
        $categoriesModel = $categoriesResource->getCategories();

        $this->renderPage('categories', $categoriesModel, 'CategoriesBlock');
    }
}
