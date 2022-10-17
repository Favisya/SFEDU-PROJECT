<?php

namespace App\Controllers\Api;

use App\Models\RedisCacheModel;
use App\Models\Resource\AuthorResource;
use App\Models\Resource\AuthorsResource;

class AuthorsController extends AbstractApiController
{
    private const cacheName = 'Authors';

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

    private function getList(bool $isPrintable = true)
    {
        $cacheModel = new RedisCacheModel();
        if (!$cacheModel->isCacheEmpty(self::cacheName) && $isPrintable) {
            $this->printJson($cacheModel->getCache(self::cacheName));
            exit;
        }

        $authorsResource = new AuthorsResource();
        $authorsModel = $authorsResource->getAuthors();

        $data = [];
        foreach ($authorsModel->getList() as $author) {
            $data[] = [
                'id'   => $author->getId(),
                'name' => $author->getName(),
            ];
        }
        if ($isPrintable) {
            $cacheModel->toCache($data, self::cacheName);
            $this->printJson($data);
        }
        return $data;
    }

    private function getElement()
    {
        $cacheModel = new RedisCacheModel();
        if (!$cacheModel->isCacheEmpty(self::cacheName)) {
            $authors = $cacheModel->getCache(self::cacheName);
            $id  = array_search($this->param, array_column($authors, 'id'));
            $author = $authors[$id];
            $this->printJson($author);
            exit;
        }

        $authorResource = new AuthorResource();
        $authorModel = $authorResource->getAuthor($this->param);

        $data = [
            'name' => $authorModel->getName(),
            'id'   => $authorModel->getId(),
        ];
        $this->updateCache(self::cacheName, $this->getList(false));
        $this->printJson($data);
    }

    private function createElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->createAuthor($name);
        header('Status: 200');

        $this->updateCache(self::cacheName, $this->getList(false));
    }

    private function editElement()
    {
        $data = $this->endCodeJson();
        $name = $data['name'];
        $authorResource = new AuthorResource();
        $authorsModel = $authorResource->editAuthor($name, $this->param);
        header('Status: 200');

        $this->updateCache(self::cacheName, $this->getList(false));
    }

    private function deleteElement()
    {
        $resource = new AuthorResource();
        $resource->deleteAuthor($this->param);
        header('Status: 200');

        $this->updateCache(self::cacheName, $this->getList(false));
    }
}
