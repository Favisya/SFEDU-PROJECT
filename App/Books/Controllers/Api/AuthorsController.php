<?php

namespace App\Books\Controllers\Api;

use App\Core\Models\CacheInterface;
use App\Books\Models\Resource\AuthorsResource;
use App\Core\Controllers\Api\AbstractApiController;

class AuthorsController extends AbstractApiController
{
    private const CACHE_NAME = 'Authors';
    protected $authorsResource;

    public function __construct(
        CacheInterface $cacheModel,
        AuthorsResource $authorsResource,
        $param = null
    ) {
        parent::__construct($cacheModel, $param);
        $this->authorsResource = $authorsResource;
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

        $authorsModel = $this->authorsResource->getAuthors();

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

        $authorModel = $this->authorsResource->getAuthor($this->param);

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
        $this->printJson($data);

        return true;
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorModel = $this->authorsResource->createAuthor($name);
        header('Status: 200');

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorModel = $this->authorsResource->editAuthor($name, $this->param);
        header('Status: 200');

        $data = $this->getAuthor($authorModel);
        $this->updateCache(self::CACHE_NAME, $data);
    }

    private function deleteElement()
    {
        $this->authorsResource->deleteAuthor($this->param);
        header('Status: 200');

        $this->cacheModel->clearCache(self::CACHE_NAME, true, $this->param);
    }
}
