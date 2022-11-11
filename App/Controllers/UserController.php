<?php

namespace App\Controllers;

use App\Blocks\UserBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\ProfileResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class UserController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UserBlock $block,
        ProfileResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $userModel = $this->resource->getUserInfo($this->getParam('id'));
        $this->renderPage('user', $this->block, $userModel);
    }
}
