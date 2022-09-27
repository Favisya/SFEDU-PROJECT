<?php

namespace App\Controllers;

use App\Models\AccountService;
use App\Models\Resource\LoginResource;
use App\Models\SessionModel;

class PostLoginController extends AbstractController
{
    public function execute()
    {
        $resource = new LoginResource();
        $loginInfo = $resource->takePassword($this->getPostParam('login'));

        $accServiceModel = new AccountService();
        $isExists = $accServiceModel->checkPassword($this->getPostParam('password'), $loginInfo);

        if (!$isExists) {
            SessionModel::getInstance()->setError('Неправильный логин или пароль');
            $this->redirect('login');
        }
        $this->redirect('profile');
    }
}
