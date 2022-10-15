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
        $this->client->auth($env->getRedisPasswd());
    }

    public function toCache(array $data, string $fileName)
    {
        $this->client->set($fileName, json_encode($data));
    }

    public function getCache(string $fileName): array
    {
        return json_decode($this->client->get($fileName));
    }

    public function isCacheEmpty(string $fileName): bool
    {
        return $this->client->exists($fileName) == 0;
    }

    public function clearCache(string $fileName)
    {
        $this->client->del($fileName);
    }
}
