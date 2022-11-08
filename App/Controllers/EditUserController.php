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
        $resource = $this->di->get(ModifyUserResource::class);

        $session = $this->di->get(SessionModel::class);
        $userModel = $resource->getUser($session->getUserId());

        $block = $this->di->get(EditUserBlock::class);
        $block->setUser($userModel);
        $block->setSession($this->di->get(SessionModel::class));
        $block->setTemplate('editUser');

        $block->render();
    }
}
