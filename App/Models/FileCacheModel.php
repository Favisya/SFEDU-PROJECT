<?php

namespace App\Models;

class FileCacheModel implements CacheInterface
{
    private $path = '/var/Cache/';

    public function toCache(array $data, string $fileName, bool $isEntity = false): bool
    {
        if (!$isEntity) {
            file_put_contents(APP_ROOT . $this->path . $fileName . '.json', json_encode($data));
            return true;
        }
        $this->addEntity($data, $fileName);

        return true;
    }

    public function getCache(string $fileName, bool $isEntity = false, int $id = null)
    {
        $data = json_decode(file_get_contents(APP_ROOT . $this->path . $fileName . '.json'), true);
        if (!$isEntity) {
            return $data;
        }
        $index = array_search($id, array_column($data, 'id'));
        $item = $data[$index];
        return $item;
    }

    public function isCacheEmpty(string $fileName): bool
    {
        if (file_exists(APP_ROOT . $this->path . $fileName . '.json')) {
            return filesize(APP_ROOT . $this->path . $fileName . '.json') != 0;
        }

        return true;
    }

    public function clearCache(string $fileName, bool $isEntity = false, int $id = null): bool
    {
        if (!$isEntity) {
            unlink(APP_ROOT . $this->path . $fileName . '.json');
            return true;
        }

        $data = json_decode(file_get_contents(APP_ROOT . $this->path . $fileName . '.json'), true);
        $index = array_search($id, array_column($data, 'id'));
        unset($data[$index]);

        file_put_contents(APP_ROOT . $this->path . $fileName . '.json', json_encode($data));
        return true;
    }

    private function addEntity(array $data, string $fileName)
    {
        if (file_exists(APP_ROOT . $this->path . $fileName . '.json')) {
            $fileData   = $this->getCache($fileName);
            $index = array_search($data['id'], array_column($fileData, 'id'));

            if ($index !== false) {
                $fileData[$index] = $data;
            } else {
                $fileData[] = $data;
            }

            file_put_contents(APP_ROOT . $this->path . $fileName . '.json', json_encode($fileData));
        } else {
            file_put_contents(APP_ROOT . $this->path . $fileName . '.json', json_encode($data));
        }
    }
}
