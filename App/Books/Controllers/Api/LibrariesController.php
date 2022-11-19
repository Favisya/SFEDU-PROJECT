<?php

namespace App\Books\Controllers\Api;

use App\Core\Models\CacheInterface;
use App\Books\Models\Resource\LibrariesResource;
use App\Core\Controllers\Api\AbstractApiController;

class LibrariesController extends AbstractApiController
{
    private const CACHE_NAME = 'libraries';
    protected $librariesResource;

    public function __construct(
        CacheInterface    $cacheModel,
        LibrariesResource $librariesResource,
                          $param = null
    ) {
        parent::__construct($cacheModel, $param);
        $this->librariesResource = $librariesResource;
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

        $librariesModel = $this->librariesResource->getLibraries();
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

        $libraryModel = $this->librariesResource->getLibrary($this->param);

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);

        return true;
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $libraryModel = $this->librariesResource->createLibrary($data['name'], $data['address']);
        header('Status: 200');

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $libraryModel = $this->librariesResource->editLibrary($data['name'], $data['address'], $this->param);
        header('Status: 200');

        $data = $this->getLibrary($libraryModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);
    }

    private function deleteElement()
    {
        $this->librariesResource->deleteLibrary($this->param);
        header('Status: 200');

        $this->cacheModel->clearCache(self::CACHE_NAME, true, $this->param);
    }
}
