<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;

class CreateLibraryController implements ControllerInterface
{
    public function execute()
    {
        $model = new LibraryModel();
        if (REQUEST_METHOD == 'GET') {
            $block = new Block();
            $block->setTemplate('createLibrary');
            $block->setModel($model);
            $block->render();
        } else {
            $model->createLibrary($_POST['libName'], $_POST['libAddress']);
        }
    }
}
