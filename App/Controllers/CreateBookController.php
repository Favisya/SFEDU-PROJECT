<?php

namespace App\Controllers;

use App\Blocks\BookFormBlock;
use App\Exceptions\MvcException;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\PublishersModel;
use App\Models\Resource\CreateBookResource;

class CreateBookController extends AbstractController
{
    public function execute()
    {
        $resource = new CreateBookResource();
        $block = new BookFormBlock();
        $block->setTemplate('createBook');

        $models = $resource->executeQuery();

        foreach ($models as $model) {
            $block->setModel($model);
        }

        $block->render();
    }
}
