<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorModel;

class AuthorController implements ControllerInterface
{
    public function execute()
    {
        $model = new AuthorModel();
        $model->setData($_GET['id']);
        $model->setBooks($_GET['id']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('author');
        $block->render();
    }
}
