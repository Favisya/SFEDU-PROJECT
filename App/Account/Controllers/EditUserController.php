<?php

namespace App\Account\Controllers;

use App\Account\Models\Resource\UsersResource;
use App\Account\Blocks\EditUserBlock;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;
use App\Core\Controllers\AbstractController;

class EditUserController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        EditUserBlock $block,
        UsersResource $resource
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
