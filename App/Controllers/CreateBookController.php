<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CountriesModel;
use App\Models\PublishersModel;

class CreateBookController implements ControllerInterface
{
    public function execute()
    {
        if (REQUEST_METHOD == 'GET') {
            $authorsModel    = new AuthorsModel();
            $countriesModel  = new CountriesModel();
            $publishersModel = new PublishersModel();

            $authorsModel->setData();
            $countriesModel->setData();
            $publishersModel->setData();

            $block = new CreateBookBlock();

            $block->setModel($authorsModel);
            $block->setModel($countriesModel);
            $block->setModel($publishersModel);

            $block->render();
        } else {
            $model = new BookModel();
            $model->createBook(
                $_POST['bookName'],
                $_POST['bookPrice'],
                $_POST['authorId'],
                $_POST['countryId'],
                $_POST['publisherId'],
                $_POST['bookDate']
            );
        }
    }
}
