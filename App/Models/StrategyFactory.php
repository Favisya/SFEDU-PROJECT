<?php

namespace App\Models;

use App\Exceptions\MvcException;
use App\Models\Resource\Environment;

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
}
