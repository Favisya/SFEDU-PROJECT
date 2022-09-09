<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\AuthorModel;

class EditAuthorController implements ControllerInterface
{
    public function execute()
    {
        $model = new AuthorModel();
        if (REQUEST_METHOD == 'GET') {
            $block = new Block();
            $block->setTemplate('createAuthor');
            $block->setModel($model);

            $model->setData($_GET['id']);

            $block->render();
        } else {
            $model->editAuthor($_POST['authorName'], $_GET['id']);
        }
    }
}