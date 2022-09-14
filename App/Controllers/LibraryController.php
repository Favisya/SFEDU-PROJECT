<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;

class LibraryController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibraryModel();

        $data = $model->executeQuery($_GET['id']);

        $model->setData($data['info']);
        $model->setBooks($data['books']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('library');
        $block->render();
    }
}
