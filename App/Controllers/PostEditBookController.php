<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\EditBookResource;

class PostEditBookController extends AbstractController
{
    public function execute()
    {
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

        $resource = new EditBookResource();
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
