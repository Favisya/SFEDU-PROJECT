<?php

namespace App\Books\Controllers\Console;

use App\Core\Controllers\Console\AbstractController;
use App\Core\Models\CacheInterface;

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
