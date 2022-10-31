<?php

namespace App\Models;

use App\Exceptions\MvcException;

class StrategyFactory
{
    public function factory(string $cacheType): CacheInterface
    {
        switch ($cacheType) {
            case 'file':
                return new FileCacheModel();
            case 'redis':
                return new RedisCacheModel();
            default:
                throw new MvcException('type is incorrect');
        }
    }

    public function getAll(): array
    {
        return [
            new FileCacheModel(),
            new RedisCacheModel(),
        ];
    }
}
