<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;

class EditLibraryController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibraryModel();
        if (REQUEST_METHOD == 'GET') {
            $block = new Block();
            $block->setTemplate('createLibrary');
            $block->setModel($model);

            $model->setData($_GET['id']);

            $block->render();
        } else {
            $model->editLibrary($_POST['libName'], $_POST['libAddress'], $_GET['id']);
        }
    }
}