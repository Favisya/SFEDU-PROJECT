<?php

namespace App\Books\Controllers\Api;

use App\Core\Models\CacheInterface;
use App\Books\Models\Resource\BooksResource;
use App\Core\Controllers\Api\AbstractApiController;

class BooksController extends AbstractApiController
{
    private $booksResource;

    public function __construct(
        CacheInterface $cacheModel,
        BooksResource $booksResource,
        $param = null
    ) {
        parent::__construct($cacheModel, $param);
        $this->booksResource = $booksResource;
    }

    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            if (!$this->param) {
                $this->getList();
            } else {
                $this->getElement();
            }
        }

        if ($this->getRequestMethod() == 'DELETE') {
            $this->deleteElement();
        }

        if ($this->getRequestMethod() == 'POST') {
            $this->createElement();
        }

        if ($this->getRequestMethod() == 'PUT') {
            $this->editElement();
        }
    }

    private function getList()
    {
        $booksModel = $this->booksResource->getBooks($this->param ?? 0);

        $data = [];
        foreach ($booksModel->getList() as $book) {
            $data[] = $this->getBook($book);
        }

        $this->printJson($data);
    }

    private function getElement()
    {
        $bookModel = $this->booksResource->getBook($this->param);
        $data = $this->getBook($bookModel);
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();

        $authorsModel = $this->booksResource->createBook(
            $data['name'],
            $data['date'],
            $data['price'],
            $data['author'],
            $data['country'],
            $data['publisher'],
            $data['category']
        );
        header('Status: 200');
    }

    private function editElement()
    {
        $data = $this->endCodeJson();

        $authorsModel = $this->booksResource->editBook(
            $data['name'],
            $data['date'],
            $data['price'],
            $data['author'],
            $data['country'],
            $data['publisher'],
            $data['category'],
            $this->param
        );
        header('Status: 200');
    }

    private function deleteElement()
    {
        $this->booksResource->deleteBook($this->param);
        header('Status: 200');
    }
}
