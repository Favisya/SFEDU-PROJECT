<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\Resource\ModifyUserResource;
use App\Models\Resource\UsersResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostEditUserController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        ModifyUserResource $resource
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
