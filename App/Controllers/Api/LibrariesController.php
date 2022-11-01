<?php

namespace App\Controllers\Api;

use App\Models\Resource\Environment;
use App\Models\Resource\LibrariesResource;
use App\Models\Resource\LibraryResource;
use App\Models\CacheFactory;

class LibrariesController extends AbstractApiController
{
    private const CACHE_NAME = 'libraries';

    public function __construct($param = null)
    {
        parent::__construct($param);
        $cacheModel = new CacheFactory();
        $env = new Environment();
        $this->cacheModel = $cacheModel->factory($env->getCacheType());
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


    private function getList(bool $isPrintable = true)
    {
        if ($this->getCacheList(self::CACHE_NAME, $this->cacheModel)) {
            return true;
        }

        $librariesResource = new LibrariesResource();
        $librariesModel = $librariesResource->getLibraries();
        $data = [];
        foreach ($librariesModel->getList() as $library) {
            $data[] = $this->getLibrary($library);
        }
        if ($isPrintable) {
            $this->cacheModel->toCache($data, self::CACHE_NAME);
            $this->printJson($data);
        }
        return $data;
    }

    private function getElement(): bool
    {
        if ($this->getCacheElement(self::CACHE_NAME, $this->cacheModel)) {
            return false;
        }


        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->getLibrary($this->param);

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);

        return true;
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->createLibrary($data['name'], $data['address']);
        header('Status: 200');

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $libraryResource = new LibraryResource();
        $libraryModel = $libraryResource->editLibrary($data['name'], $data['address'], $this->param);
        header('Status: 200');

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);
    }

    private function deleteElement()
    {
        $resource = new LibraryResource();
        $resource->deleteLibrary($this->param);
        header('Status: 200');

        $this->cacheModel->clearCache(self::CACHE_NAME, true, $this->param);
    }
}
