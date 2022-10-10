<?php

namespace App\Controllers\Api;

use App\Models\Resource\AuthorResource;
use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractApiController
{
    public function execute()
    {
        if ($this->isGet()) {
            if (!$this->param) {
                $this->getList();
            } else {
                $this->getElement();
            }
        }

        if ($this->isDelete()) {
            $this->deleteElement();
        }

        if ($this->isPost()) {
            $this->createElement();
        }

        if ($this->isPut()) {
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
        $this->printJson($data);
    }

    private function getElement()
    {
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->getAuthor($this->param);

        $data = [
            'name' => $authorModel->getName(),
            'id'   => $authorModel->getId(),
        ];
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->createAuthor($name);
        header('Status: 200');
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->editAuthor($name, $this->param);
        header('Status: 200');
    }

    private function deleteElement()
    {
        $resource = new AuthorResource();
        $resource->deleteAuthor($this->param);
        header('Status: 200');
    }
}
