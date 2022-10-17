<?php

namespace App\Models\Resource;

use App\Models\FileCacheModel;
use App\Models\RedisCacheModel;
use App\Models\StrategyFactory;

class Environment
{
    protected $settings;
    private const CACHENAME = 'environment';
    private $cacheModel;

    public function __construct()
    {
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
    }

    public function getDatabase()
    {
        return $this->settings['DATABASE'];
    }

    public function getUri()
    {
        return reset($this->settings['CACHE']['URI']);
    }

    public function getCache()
    {
        return $this->settings['CACHE'];
    }
}
