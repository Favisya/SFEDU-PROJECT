<?php

namespace App\Controllers;

use App\Models\AccountService;
use App\Models\Resource\LoginResource;
use App\Models\SessionModel;

class PostLoginController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();

        $AccountModel = $this->di->get(AccountService::class);
        $AccountModel->setResource($this->di->get(LoginResource::class));

        $isExists = $AccountModel->authenticate(
            $this->getPostParam('login'),
            $this->getPostParam('password')
        );

        if (!$isExists) {
            $session = $this->di->get(SessionModel::class);
            $session->setError('Неправильный логин или пароль');
            $this->redirect('login');
        }
        $this->redirect('profile');
    }
}
