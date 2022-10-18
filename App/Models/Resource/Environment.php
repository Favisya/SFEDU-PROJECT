<?php

namespace App\Models\Resource;

use App\Models\StrategyFactory;

class Environment
{
    protected $settings;
    private const CACHENAME = 'environment';
    private $cacheModel;

    public function __construct()
    {
        $factory = new StrategyFactory();
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
        $this->cacheModel = $factory->factory($this->settings['CACHE']['TYPE']);
        if ($this->cacheModel->isCacheEmpty(self::CACHENAME)) {
            $this->cacheModel->toCache($this->settings, self::CACHENAME, true);
        }
    }

    public function getDatabase()
    {
        return $this->cacheModel->getCache(self::CACHENAME)['DATABASE'];
    }

    public function getUri()
    {
        return reset($this->cacheModel->getCache(self::CACHENAME)['CACHE']['URI']);
    }

    public function getCacheType()
    {
        return $this->cacheModel->getCache(self::CACHENAME)['CACHE']['TYPE'];
    }
}
