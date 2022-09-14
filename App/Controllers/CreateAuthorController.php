<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;

class CreateAuthorController implements ControllerInterface
{
    public function execute()
    {
        $model = new AuthorModel();
        if (REQUEST_METHOD == 'GET') {
            $block = new Block();
            $block->setTemplate('createAuthor');
            $block->setModel($model);

            $block->render();
        } else {
            $model->createAuthor($_POST['authorName']);
        }
    }
}
