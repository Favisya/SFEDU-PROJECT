<?php

namespace App\Controllers\Api;

use App\Models\Resource\AuthorResource;
use App\Models\Resource\AuthorsResource;
use App\Models\Resource\Environment;
use App\Models\StrategyFactory;

class AuthorsController extends AbstractApiController
{
    private const CACHE_NAME = 'Authors';

    public function __construct($param = null)
    {
        parent::__construct($param);
        $cacheModel = new StrategyFactory();
        $env = new Environment();
        $this->cacheModel = $cacheModel->factory($env->getCacheType());
    }

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

    private function getList(bool $isOnlyData = true)
    {
        if ($this->getCacheList(self::CACHE_NAME, $this->cacheModel)) {
            return true;
        }

        $authorsResource = new AuthorsResource();
        $authorsModel = $authorsResource->getAuthors();

        $data = [];
        foreach ($authorsModel->getList() as $author) {
            $data[] = $this->getAuthor($author);
        }
        if ($isOnlyData) {
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

        $authorResource = new AuthorResource();
        $authorModel = $authorResource->getAuthor($this->param);

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);

        return true;
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->createAuthor($name);
        header('Status: 200');

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorModel = $authorResource->editAuthor($name, $this->param);
        header('Status: 200');

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
    }

    private function deleteElement()
    {
        $resource = new AuthorResource();
        $resource->deleteAuthor($this->param);
        header('Status: 200');

        $this->cacheModel->clearCache(self::CACHE_NAME, true, $this->param);
    }
}
