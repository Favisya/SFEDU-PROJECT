<?php

namespace App\Controllers;

use App\Models\AbstractModel;
use App\Models\Resource\Environment;

abstract class AbstractController
{
    public function execute()
    {
    }

    public function commonExecute(string $template, AbstractModel $model = null, string $blockName = 'Block')
    {
        $blockName = '\App\Blocks\\' . $blockName;

        $block = new $blockName();
        $block->setTemplate($template);
        if ($model != null) {
            $block->setModel($model);
        }

        $block->render();
    }

    public function getPostParam(string $key)
    {
        return $_POST[$key] ?? null;
    }

    public function redirect(string $path)
    {
        $environment = new Environment();
        header("Location: " . $environment->getUri() . $path);
    }

    public function checkSession(): bool
    {
        if (isset($_SESSION['id'])) {
            return true;
        }
        return false;
    }
}
