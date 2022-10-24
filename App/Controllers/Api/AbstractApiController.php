<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\AuthorModel;
use App\Models\BookModel;
use App\Models\CacheInterface;
use App\Models\LibraryModel;

abstract class AbstractApiController extends AbstractController
{
    protected $param;
    protected $cacheModel;

    public function __construct($param = null)
    {
        $this->param = $param;
    }

    /**
     * @param $data array, object
     * @return void
     */
    public function printJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getBook(BookModel $book): ?array
    {
        $data = [
            'id'        => $book->getId(),
            'name'      => $book->getName(),
            'price'     => $book->getPrice(),
            'author'    => $book->getAuthor(),
            'country'   => $book->getCountry(),
            'publisher' => $book->getPublisher(),
            'date'      => $book->getDate(),
        ];
        return $data ?? null;
    }

    public function getAuthor(AuthorModel $authorModel): ?array
    {
        return [
            'id'   => $authorModel->getId(),
            'name' => $authorModel->getName(),
        ] ?? null;
    }

    public function getLibrary(LibraryModel $libraryModel): ?array
    {
        return [
            'id'      => $libraryModel->getId(),
            'name'    => $libraryModel->getName(),
            'address' => $libraryModel->getAddress(),
        ] ?? null;
    }

    public function endCodeJson()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function isPut(): bool
    {
        return $this->getRequestMethod() == 'PUT';
    }

    public function isGet(): bool
    {
        return $this->getRequestMethod() == 'GET';
    }

    public function isPost(): bool
    {
        return $this->getRequestMethod() == 'POST';
    }

    public function isDelete(): bool
    {
        return $this->getRequestMethod() == 'DELETE';
    }

    public function updateCache(string $file, $data, bool $isEntity = true)
    {
        if (!$isEntity) {
            $this->cacheModel->clearCache($file);
        }
        $this->cacheModel->toCache($data, $file, $isEntity);
    }


    protected function getCacheElement(string $cacheName, CacheInterface $cacheModel): bool
    {
        if (!$cacheModel->isCacheEmpty($cacheName)) {
            $item = $cacheModel->getCache($cacheName, true, $this->param);
            $this->printJson($item);
            return true;
        }

        return false;
    }

    protected function getCacheList(string $cacheName, CacheInterface $cacheModel): bool
    {
        if (!$cacheModel->isCacheEmpty($cacheName)) {
            $this->printJson($cacheModel->getCache($cacheName));
            return true;
        }
        return false;
    }
}
