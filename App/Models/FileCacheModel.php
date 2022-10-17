<?php

namespace App\Models;

class FileCacheModel implements CacheInterface
{
    private $path = '/var/Cache/';

    public function toCache(array $data, string $fileName, bool $isEntity = false)
    {
        if (!$isEntity) {
            $data = json_encode($data);
            file_put_contents(APP_ROOT . $this->path . $fileName . '.json', $data);
            exit;
        }
        $this->addEntity($data, $fileName);
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
            return filesize(APP_ROOT . $this->path . $fileName . '.json') == 0;
        }

        return true;
    }

    public function clearCache(string $fileName)
    {
        file_put_contents(APP_ROOT . $this->path . $fileName . '.json', '');
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
        }
    }
}
