<?php

namespace App\Controllers;

use App\Models\Resource\LoginResource;
use App\Models\SessionModel;

class PostLoginController extends AbstractController
{
    public function execute()
    {
        $resource = new LoginResource();
        $verify = $resource->executeQuery($_POST['login'], $_POST['password']);

        if (!$verify) {
            SessionModel::getInstance()->setError('Неправильный логин или пароль');
            $this->redirect('login');
        }
        $this->redirect('profile');
    }
}