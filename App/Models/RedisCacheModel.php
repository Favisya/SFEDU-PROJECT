<?php

namespace App\Models;

use App\Models\Resource\Environment;
use Predis\Client;

class RedisCacheModel implements CacheInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $env = new Environment();
        $this->client->auth($env->getCache()['PASSWORD']);
    }

    public function toCache(array $data, string $fileName, bool $isEntity = false)
    {
        if (!$isEntity) {
            foreach ($data as $item) {
                $this->addEntity($item, $fileName);
            }
        }

        $this->addEntity($data, $fileName);
    }

    public function getCache(string $fileName, bool $isEntity = false, int $id = null): array
    {
        if (!$isEntity) {
            $keys = $this->client->keys($fileName . '*');
            $data = [];
            foreach ($keys as $key) {
                $data[] = json_decode($this->client->get($key));
            }
            return $data;
        }
        return json_decode($this->client->get($fileName . '_' . $id), true);
    }

    public function isCacheEmpty(string $fileName): bool
    {
        return $this->client->exists($this->getMultipleString($fileName)) > 0;
    }

    public function clearCache(string $fileName, bool $isEntity = false, int $id = null)
    {
        if (!$isEntity) {
            $this->client->del($this->getMultipleString($fileName));
        }
        $this->client->del($this->getMultipleString($fileName . '_' . $id));
    }


    private function addEntity(array $data, string $fileName)
    {
        $this->client->set($fileName . '_' . $data['id'], json_encode($data));
    }

    private function getMultipleString(string $fileName): string
    {
        $keys = $this->client->keys($fileName . '*');
        $multipleKey = '';
        foreach ($keys as $key) {
            $multipleKey .= $key . ' ';
        }
        return $multipleKey;
    }
}
