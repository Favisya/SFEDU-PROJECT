<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorsModel;

class AuthorsController implements ControllerInterface
{
    public function execute()
    {
        $model = new AuthorsModel();
        $data = $model->executeQuery();
        $model->setData($data);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('authors');
        $block->render();
    }
}
