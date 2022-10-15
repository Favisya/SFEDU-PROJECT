<?php

namespace App\Controllers\Api;

use App\Models\RedisCacheModel;
use App\Models\Resource\LibrariesResource;
use App\Models\Resource\LibraryResource;

class LibrariesController extends AbstractApiController
{
    private $cacheName = 'libraries';

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


    private function getList(bool $isPrintable = true)
    {
        $cacheModel = new RedisCacheModel();
        if (!$cacheModel->isCacheEmpty($this->cacheName) && $isPrintable) {
            $this->printJson($cacheModel->getCache($this->cacheName));
            exit;
        }

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
        if ($isPrintable) {
            $cacheModel->toCache($data, $this->cacheName);
            $this->printJson($data);
        }
        return $data;
    }

    private function getElement()
    {
        $cacheModel = new RedisCacheModel();
        if (!$cacheModel->isCacheEmpty($this->cacheName)) {
            $libraries = $cacheModel->getCache($this->cacheName);
            $id  = array_search($this->param, array_column($libraries, 'id'));
            $library = $libraries[$id];
            $this->printJson($library);
            return true;
        }

        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->getLibrary($this->param);

        $data = [
            'id'      => $libraryModel->getId(),
            'name'    => $libraryModel->getName(),
            'address' => $libraryModel->getAddress(),
        ];
        $this->updateCache($this->cacheName, $this->getList(false));
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $authorsModel = $libraryResource->createLibrary($data['name'], $data['address']);
        header('Status: 200');

        $this->updateCache($this->cacheName, $this->getList(false));
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $authorsModel = $libraryResource->editLibrary($data['name'], $data['address'], $this->param);
        header('Status: 200');

        $this->updateCache($this->cacheName, $this->getList(false));
    }

    private function deleteElement()
    {
        $resource = new LibraryResource();
        $resource->deleteLibrary($this->param);
        header('Status: 200');

        $this->updateCache($this->cacheName, $this->getList(false));
    }
}
