<?php

namespace App\Account\Controllers;

use App\Account\Blocks\UsersBlock;
use App\Account\Models\Resource\UsersResource;
use App\Core\Models\Resource\Environment;
use App\Core\Controllers\AbstractController;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class UsersController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UsersBlock $block,
        UsersResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }
    public function execute()
    {
        $model = $this->resource->getUsers();
        $this->renderPage('users', $this->block, $model);
    }
}
