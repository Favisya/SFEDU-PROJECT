<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BookModel;

class BookController implements ControllerInterface
{
    public function execute()
    {
        $model = new BookModel();
        $model->setData($_GET['id']);
        $model->setLibs($_GET['id']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('book');
        $block->render();
    }
}
