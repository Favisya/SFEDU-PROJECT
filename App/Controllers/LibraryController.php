<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;

class LibraryController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibraryModel();
        $model->setData($_GET['id']);
        $model->setBooks($_GET['id']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('library');
        $block->render();
    }
}
