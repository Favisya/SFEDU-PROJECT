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

        $AccountModel = new AccountService();
        $AccountModel->setResource(new LoginResource());

        $isExists = $AccountModel->authenticate(
            $this->getPostParam('login'),
            $this->getPostParam('password')
        );

        if (!$isExists) {
            SessionModel::getInstance()->setError('Неправильный логин или пароль');
            $this->redirect('login');
        }
        $this->redirect('profile');
    }
}
