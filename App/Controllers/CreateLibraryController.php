<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\LibraryModel;

class CreateLibraryController implements ControllerInterface
{
    public function execute()
    {
        if (REQUEST_METHOD == 'GET') {
            $block = new Block();
            $block->setTemplate('createLibrary');
            $block->render();
        } else {
            $model = new LibraryModel();
            $model->createLibrary($_POST['libName'], $_POST['libAddress']);
        }
    }
}
