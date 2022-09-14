<?php

namespace App\Controllers;

use App\Blocks\BookFormBlock;
use App\Exceptions\MvcException;
use App\Models\Resource\EditBookResource;

class EditBookController extends AbstractController
{
    public function execute()
    {
        $resource = new EditBookResource();
        if ($this->isGetMethod()) {
            $block = new BookFormBlock();
            $block->setTemplate('createBook');

            $models = $resource->executeQuery($_GET['id']);

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
                && $this->getPostParam('categoryId')
                && $_GET['id'];

            if (!$checker) {
                throw new MvcException('Input type is wrong');
            }

            $resource->editBook(
                $_POST['bookName'],
                $_POST['bookDate'],
                $_POST['bookPrice'],
                $_POST['authorId'],
                $_POST['countryId'],
                $_POST['publisherId'],
                $_POST['categoryId'],
                $_GET['id']
            );
        }
    }
}
