<?php

namespace App\Controllers;

use App\Blocks\FormBlock;
use App\Models\Resource\ModifyUserResource;
use App\Models\SessionModel;

class EditUserController extends AbstractController
{
    public function execute()
    {
        $resource = new ModifyUserResource();
        $userModel = $resource->getUser($_SESSION['id']);

        $block = new FormBlock();
        $block->setModel($userModel);
        $block->setModel(SessionModel::getInstance());
        $block->setTemplate('editUser');

        $block->render();
    }
}
