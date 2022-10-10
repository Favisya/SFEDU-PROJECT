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
            $data[] = [
                'id'        => $book->getId(),
                'name'      => $book->getName(),
                'price'     => $book->getPrice(),
                'author'    => $book->getAuthor(),
                'country'   => $book->getCountry(),
                'publisher' => $book->getPublisher(),
                'date'      => $book->getYear(),
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function getElement()
    {
        $bookResource = new BookResource();
        $bookModel = $bookResource->getBook($this->param);
        $data = [
            'id'        => $bookModel->getId(),
            'name'      => $bookModel->getName(),
            'price'     => $bookModel->getPrice(),
            'author'    => $bookModel->getAuthor(),
            'country'   => $bookModel->getCountry(),
            'publisher' => $bookModel->getPublisher(),
            'date'      => $bookModel->getYear(),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function createElement()
    {
        $data = json_decode(file_get_contents('php://input'), true);

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
        header('Status: success');
    }

    private function editElement()
    {
        $data = json_decode(file_get_contents('php://input'), true);

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
        header('Status: success');
    }

    private function deleteElement()
    {
        $bookResource = new bookResource();
        $bookResource->deleteBook($this->param);
        header('Status: success');
    }
}
