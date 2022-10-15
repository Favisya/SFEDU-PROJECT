<?php

namespace App\Models;

interface CacheInterface
{
    public function toCache(array $data, string $fileName);

    public function getCache(string $fileName);

    public function isCacheEmpty(string $fileName): bool;

    public function clearCache(string $fileName);
}
