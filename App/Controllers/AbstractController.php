<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\ModelAbstract;

abstract class AbstractController
{
    public function execute()
    {
    }

    public function commonExecute(string $template, ModelAbstract $model = null, string $blockName = 'Block')
    {
        $blockName = '\App\Blocks\\' . $blockName;

        $block = new $blockName();
        $block->setTemplate($template);
        if ($model != null) {
            $block->setModel($model);
        }

        $block->render();
    }

    public function isGetMethod(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        }

        return false;
    }

    public function getPostParam(string $key)
    {
        return $_POST["$key"] ?? null;
    }
}
