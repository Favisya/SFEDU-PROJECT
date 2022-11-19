<?php

namespace App\Books\Controllers;

use App\Core\Exceptions\MvcException;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\BooksResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class PostCreateBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        BooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $keys = array_keys($_POST);
        foreach ($keys as $key) {
            if (!$this->getPostParam($key)) {
                throw new MvcException('Input type is wrong');
            }
        }

        $this->handleToken();

        $this->validateForm(['bookName']);

        $bookModel = $this->resource->createBook(
            $this->getPostParam('bookName'),
            $this->getPostParam('bookDate'),
            $this->getPostParam('bookPrice'),
            $this->getPostParam('authorId'),
            $this->getPostParam('countryId'),
            $this->getPostParam('publisherId'),
            $this->getPostParam('categoryId'),
        );

        $this->redirect('book?id=' . $bookModel->getList()['id']);
    }
}
