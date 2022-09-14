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
        if ($this->isGetMethod()) {
            $block = new BookFormBlock();
            $block->setTemplate('createBook');

            $models = $resource->executeQuery();

            foreach ($models as $model) {
                $block->setModel($model);
            }

            $block->render();
        } else {
            $checker = $this->getPostParam('bookName')
                && $this->getPostParam('bookDate')
                && $this->getPostParam('bookPrice')
                && $this->getPostParam('authorId')
                && $this->getPostParam('countryId')
                && $this->getPostParam('publisherId')
                && $this->getPostParam('categoryId');

            if (!$checker) {
                throw new MvcException('Input type is wrong');
            }
            $resource->createBook(
                $_POST['bookName'],
                $_POST['bookDate'],
                $_POST['bookPrice'],
                $_POST['authorId'],
                $_POST['countryId'],
                $_POST['publisherId'],
                $_POST['categoryId']
            );
        }
    }
}
