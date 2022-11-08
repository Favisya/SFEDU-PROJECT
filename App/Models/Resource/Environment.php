<?php

namespace App\Models\Resource;

use App\Models\CacheFactory;

class Environment
{
    protected $settings;
    private const CACHE_NAME = 'environment';
    private $cacheModel;

    public function __construct()
    {
        $factory = new CacheFactory();
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
        $this->cacheModel = $factory->factory($this->settings['CACHE']['TYPE']);
        if ($this->cacheModel->isCacheEmpty(self::CACHE_NAME)) {
            $this->cacheModel->toCache($this->settings, self::CACHE_NAME, true);
        }
    }

    public function getDatabase()
    {
        return $this->cacheModel->getCache(self::CACHE_NAME)['DATABASE'];
    }

    public function getUri()
    {
        return $this->cacheModel->getCache(self::CACHE_NAME)['CACHE']['URI'];
    }

    public function getCacheType()
    {
        return $this->cacheModel->getCache(self::CACHE_NAME)['CACHE']['TYPE'];
    }

    public function getMailerKey()
    {
        return $this->cacheModel->getCache(self::CACHE_NAME)['MAILER']['KEY'];
    }

    public function getEmail()
    {
        return $this->cacheModel->getCache(self::CACHE_NAME)['MAILER']['EMAIL'];
    }
}
