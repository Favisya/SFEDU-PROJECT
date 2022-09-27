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
            $this->getPostParam('bookName'),
            $this->getPostParam('bookDate'),
            $this->getPostParam('authorId'),
            $this->getPostParam('countryId'),
            $this->getPostParam('publisherId'),
            $this->getPostParam('categoryId'),
            $this->getPostParam('bookName')
        );

        $this->redirect('book?id=' . $bookModel->getData()['id']);
    }
}
