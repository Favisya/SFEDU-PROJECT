<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\EditBookResource;

class PostEditBookController extends AbstractController
{
    public function execute()
    {
        $keys = array_keys($_POST);
        foreach ($keys as $key) {
            if (!$this->getPostParam($key)) {
                throw new MvcException('Input type is wrong');
            }
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
