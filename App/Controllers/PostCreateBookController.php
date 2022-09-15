<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\CreateBookResource;

class PostCreateBookController extends AbstractController
{
    public function execute()
    {
        $keys = array_keys($_POST);
        foreach ($keys as $key) {
            if (!$this->getPostParam($key)) {
                throw new MvcException('Input type is wrong');
            }
        }

        $resource = new CreateBookResource();
        $bookModel = $resource->createBook(
            $_POST['bookName'],
            $_POST['bookDate'],
            $_POST['bookPrice'],
            $_POST['authorId'],
            $_POST['countryId'],
            $_POST['publisherId'],
            $_POST['categoryId']
        );

        $this->redirect('book?id=' . $bookModel->getData()['id']);
    }
}
