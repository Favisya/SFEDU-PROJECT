<?php

namespace App\Models;

class FileCacheModel implements CacheInterface
{
    private $path = '/App/var/Cache/';

    public function toCache(array $data, string $fileName)
    {
        file_put_contents(APP_ROOT . $this->path . $fileName . '.json', json_encode($data));
    }

    public function getCache(string $fileName)
    {
        return json_decode(file_get_contents(APP_ROOT . $this->path . $fileName . '.json'));
    }

    public function isCacheEmpty(string $fileName): bool
    {
        return filesize(APP_ROOT . $this->path . $fileName . '.json') == 0;
    }

    public function clearCache(string $fileName)
    {
        file_put_contents(APP_ROOT . $this->path . $fileName . '.json', '');
    }
}
