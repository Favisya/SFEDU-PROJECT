<?php

namespace App\Controllers\Console;

use App\Models\StrategyFactory;

class ClearCacheController extends AbstractController
{
    public function execute()
    {
        $cacheModels = new StrategyFactory();

        foreach ($cacheModels->getAll() as $cacheModel) {
            $arguments = $this->getArgument();
            $cacheModel->clearCache(reset($arguments));
        }
    }
}
