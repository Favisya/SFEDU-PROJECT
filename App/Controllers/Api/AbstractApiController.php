<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\BookModel;
use App\Models\RedisCacheModel;

abstract class AbstractApiController extends AbstractController
{
    protected $param;

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
            'date'      => $book->getYear(),
        ];
        return $data ?? null;
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
        return $this->getRequestMethod() == 'PUT';
    }

    public function updateCache(string $file, $data)
    {
        $cacheModel = new RedisCacheModel();
        $cacheModel->clearCache($file);
        $cacheModel->toCache($data, $file);
    }
}
