<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;

class AuthorController implements ControllerInterface
{
    public function execute()
    {
        $model = new AuthorModel();
        $data = $model->executeQuery($_GET['id']);
        $model->setData($data['info']);
        $model->setBooks($data['books']);

        $block = new Block();
        $block->setModel($model);
        $block->setTemplate('author');
        $block->render();
    }
}
