<?php

namespace App\Controllers\Api;

use App\Models\Resource\AuthorResource;
use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractApiController
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
        $authorsResource = new AuthorsResource();
        $authorsModel = $authorsResource->getAuthors();

        $data = [];
        foreach ($authorsModel->getList() as $author) {
            $data[] = [
                'id'   => $author->getId(),
                'name' => $author->getName(),
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function getElement()
    {
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->getAuthor($this->param);

        $data = [
            'name' => $authorModel->getName(),
            'id'   => $authorModel->getId(),
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function createElement()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->createAuthor($name);
        header('Status: success');
    }

    private function editElement()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->editAuthor($name, $this->param);
        header('Status: success');
    }

    private function deleteElement()
    {
        $resource = new AuthorResource();
        $resource->deleteAuthor($this->param);
        header('Status: success');
    }
}
