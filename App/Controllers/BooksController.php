<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\BooksModel;

class BooksController implements ControllerInterface
{
    public function execute()
    {
        $model = new BooksModel();
        $data = $model->executeQuery($_GET['author_id'] ?? 0);
        $model->setData($data);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('books');
        $block->render();
    }
}
