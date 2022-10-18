<?php

namespace App\Models;

interface CacheInterface
{
    public function toCache(array $data, string $fileName, bool $isEntity);

    public function getCache(string $fileName, bool $isEntity, int $id);

    public function isCacheEmpty(string $fileName): bool;

    public function clearCache(string $fileName, bool $isEntity, int $id);
}
