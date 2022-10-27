<?php

namespace App\Models;

use Predis\Client;

class RedisCacheModel implements CacheInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
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
                $data[] = json_decode($this->client->get($key), true);
            }

            if (count($data) == 1) {
                return reset($data);
            }
            return $data;
        }
        return json_decode($this->client->get($fileName . '_' . $id), true);
    }

    public function isCacheEmpty(string $fileName): bool
    {
        $keys = $this->getKeys($fileName);
        $count = 0;
        foreach ($keys as $key) {
            $count += $this->client->exists($key);
        }
        if ($count == count($keys)) {
            return true;
        }

        return false;
    }

    public function clearCache(string $fileName, bool $isEntity = false, int $id = null)
    {
        if (!$isEntity) {
            $this->client->del($this->getKeys($fileName));
        }
        $this->client->del($fileName . '_' . $id);
    }


    private function addEntity(array $data, string $fileName)
    {
        $addString = '';
        if (isset($data['id'])) {
            $addString = '_' . $data['id'];
        }
        $this->client->set($fileName . $addString, json_encode($data));
    }

    private function getKeys(string $fileName)
    {
        $keys = $this->client->keys($fileName . '*');
        if (empty($keys)) {
            return $fileName;
        }

        return $keys;
    }
}
