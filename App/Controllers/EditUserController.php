<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Blocks\EditUserBlock;
use App\Models\Resource\ModifyUserResource;
use App\Models\SessionModel;

class EditUserController extends AbstractController
{
    public function execute()
    {
        $resource = new ModifyUserResource();
        $userModel = $resource->getUser(SessionModel::getInstance()->getUserId());

        $block = new EditUserBlock();
        $block->setUser($userModel);
        $block->setSession(SessionModel::getInstance());
        $block->setTemplate('editUser');

        $block->render();
    }
}
