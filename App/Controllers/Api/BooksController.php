<?php

namespace App\Controllers\Api;

use App\Models\Resource\BookResource;
use App\Models\Resource\BooksResource;

class BooksController extends AbstractApiController
{
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
        $booksResource = new BooksResource();
        $booksModel = $booksResource->getBooks($this->param ?? 0);

        $data = [];
        foreach ($booksModel->getList() as $book) {
            $data[] = $this->getBook($book);
        }

       $this->printJson($data);
    }

    private function getElement()
    {
        $bookResource = new BookResource();
        $bookModel = $bookResource->getBook($this->param);
        $data = $this->getBook($bookModel);
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();

        $BookResource = new BookResource();
        $authorsModel = $BookResource->createBook(
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

        $BookResource = new BookResource();
        $authorsModel = $BookResource->editBook(
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
        $bookResource = new bookResource();
        $bookResource->deleteBook($this->param);
        header('Status: 200');
    }
}
