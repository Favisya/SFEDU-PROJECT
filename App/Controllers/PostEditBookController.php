<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\BookResource;

class PostEditBookController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['bookName']);

        $keys = array_keys($_POST);
        foreach ($keys as $key) {
            if (!$this->getPostParam($key)) {
                throw new MvcException('Input type is wrong');
            }
        }

        $resource = $this->di->get(BookResource::class);
        $bookModel = $resource->editBook(
            $this->getPostParam('bookName'),
            $this->getPostParam('bookDate'),
            $this->getPostParam('bookPrice'),
            $this->getPostParam('authorId'),
            $this->getPostParam('countryId'),
            $this->getPostParam('publisherId'),
            $this->getPostParam('categoryId'),
            $this->getParam('id')
        );

        $this->redirect('book?id=' . $bookModel->getList()['id']);
    }
}
