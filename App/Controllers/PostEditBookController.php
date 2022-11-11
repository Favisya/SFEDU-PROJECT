<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Exceptions\MvcException;
use App\Models\Resource\BookResource;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostEditBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BookResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

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

        $resource = $this->resource;
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
