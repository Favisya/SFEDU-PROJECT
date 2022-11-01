<?php

namespace App\Controllers\Console;

use App\Models\CacheFactory;

class ClearCacheController extends AbstractController
{
    public function execute()
    {
        $cacheModels = new CacheFactory();

        foreach ($cacheModels->getAll() as $cacheModel) {
            $arguments = $this->getArguments();
            $cacheModel->clearCache(reset($arguments));
        }
    }
}
