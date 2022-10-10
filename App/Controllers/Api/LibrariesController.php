<?php

namespace App\Controllers\Api;

use App\Models\Resource\LibrariesResource;
use App\Models\Resource\LibraryResource;

class LibrariesController extends AbstractApiController
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
        $librariesResource = new LibrariesResource();
        $librariesModel = $librariesResource->getLibraries();
        $data = [];
        foreach ($librariesModel->getList() as $author) {
            $data[] = [
                'id'      => $author->getId(),
                'name'    => $author->getName(),
                'address' => $author->getAddress(),
            ];
        }
        $this->printJson($data);
    }

    private function getElement()
    {
        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->getLibrary($this->param);

        $data = [
            'id'      => $libraryModel->getId(),
            'name'    => $libraryModel->getName(),
            'address' => $libraryModel->getAddress(),
        ];
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $authorsModel = $libraryResource->createLibrary($data['name'], $data['address']);
        header('Status: 200');
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $authorsModel = $libraryResource->editLibrary($data['name'], $data['address'], $this->param);
        header('Status: 200');
    }

    private function deleteElement()
    {
        $resource = new LibraryResource();
        $resource->deleteLibrary($this->param);
        header('Status: 200');
    }
}
