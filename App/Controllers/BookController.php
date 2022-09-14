<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BookModel;

class BookController implements ControllerInterface
{
    public function execute()
    {
        $model = new BookModel();
        $data = $model->executeQuery($_GET['id']);

        $model->setData($data['info']);
        $model->setLibs($data['books']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('book');
        $block->render();
    }
}
