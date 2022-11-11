<?php

namespace App\Controllers\Console;

use App\Models\CacheInterface;

class ClearCacheController extends AbstractController
{
    private $cacheModel;

    public function __construct(CacheInterface $cacheModel)
    {
        $this->cacheModel = $cacheModel;
    }

    public function execute()
    {
        $arguments = $this->getArguments();
        $this->cacheModel->clearCache(reset($arguments));
    }
}
