<?php

namespace App\Controllers\Console;

use App\Models\FileCacheModel;
use App\Models\RedisCacheModel;

class ClearCacheController extends AbstractController
{
    public function execute()
    {
        $fileCacheModel = new FileCacheModel();
        $redisCacheModel = new RedisCacheModel();

        $redisCacheModel->clearCache($this->getArgument());
        $fileCacheModel->clearCache($this->getArgument());
    }
}
