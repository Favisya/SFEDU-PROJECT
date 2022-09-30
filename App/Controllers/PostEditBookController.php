<?php

namespace App\Controllers;

use App\Exceptions\MvcException;
use App\Models\Resource\EditBookResource;

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

        $resource = new EditBookResource();
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

        $this->redirect('book?id=' . $bookModel->getData()['id']);
    }
}
