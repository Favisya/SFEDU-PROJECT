<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Exceptions\MvcException;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\PublishersModel;

class CreateBookController implements ControllerInterface
{
    public function execute()
    {
        $bookModel = new BookModel();
        if (REQUEST_METHOD == 'GET') {
            $authorsModel    = new AuthorsModel();
            $countriesModel  = new CountriesModel();
            $publishersModel = new PublishersModel();
            $categoriesModel = new CategoriesModel();

            $authors    = $authorsModel->executeQuery();
            $countries  = $countriesModel->executeQuery();
            $publishers = $publishersModel->executeQuery();
            $categories = $categoriesModel->executeQuery();

            $authorsModel->setData($authors);
            $countriesModel->setData($countries);
            $publishersModel->setData($publishers);
            $categoriesModel->setData($categories);

            $block = new CreateBookBlock();
            $block->setTemplate('createBook');

            $block->setModel($authorsModel);
            $block->setModel($countriesModel);
            $block->setModel($publishersModel);
            $block->setModel($categoriesModel);
            $block->setModel($bookModel);

            $block->render();
        } else {
            if (
                gettype($_POST['bookDate']) != 'string'
                || gettype($_POST['bookPrice'])   != 'integer'
                || gettype($_POST['authorId'])    != 'integer'
                || gettype($_POST['countryId'])   != 'integer'
                || gettype($_POST['publisherId']) != 'integer'
                || gettype($_POST['categoryId'])  != 'integer'
            ) {
                throw new MvcException('Input type is wrong');
            }

            $bookModel->createBook(
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
