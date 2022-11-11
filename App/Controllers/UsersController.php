<?php

namespace App\Controllers;

use App\Blocks\UsersBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\UsersResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

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
