<?php

namespace App\Account\Controllers;

use App\Account\Models\Resource\UsersResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class PostEditUserController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UsersResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['surname', 'name']);
        $session = $this->session;

        $this->resource->editUser(
            $this->getPostParam('password'),
            $this->getPostParam('name'),
            $this->getPostParam('surname'),
            $this->getPostParam('email'),
            $session->getUserId()
        );

        $this->redirect('profile');
    }
}
