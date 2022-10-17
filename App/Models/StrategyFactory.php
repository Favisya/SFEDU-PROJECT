<?php

namespace App\Models;

use App\Exceptions\MvcException;
use App\Models\Resource\Environment;

class StrategyFactory
{
    public function factory(): CacheInterface
    {
        $env = new Environment();
        $cacheType = $env->getCache()['TYPE'];

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
