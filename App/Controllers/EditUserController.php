<?php

namespace App\Controllers;

use App\Blocks\EditUserBlock;
use App\Blocks\UserBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\ModifyUserResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class EditUserController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        EditUserBlock $block,
        ModifyUserResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $resource = $this->resource;

        $session = $this->session;
        $userModel = $resource->getUser($session->getUserId());

        $block = $this->block;
        $block->setUser($userModel);
        $block->setSession($session);
        $block->setTemplate('editUser');

        $block->render();
    }
}
