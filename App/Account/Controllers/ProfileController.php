<?php

namespace App\Account\Controllers;

use App\Account\Models\Resource\UsersResource;
use App\Account\Blocks\UserBlock;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class ProfileController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UserBlock $block,
        UsersResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $userModel = $this->resource->getUserInfo($this->session->getUserId());
        $this->renderPage('profile', $this->block, $userModel);
    }
}
