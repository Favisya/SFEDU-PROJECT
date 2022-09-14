<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CategoriesModel;
use App\Models\Resource\CategoriesResource;

class CategoriesController extends AbstractController
{
    public function execute()
    {
        $categoriesModel = new CategoriesModel();
        $categoriesResource = new CategoriesResource();

        $data = $categoriesResource->executeQuery();
        $categoriesModel->setData($data);

        $this->commonExecute('categories', $categoriesModel);
    }
}
