<?php

namespace App\Controllers;

use App\Models\Resource\RegistrationResource;
use App\Models\SessionModel;

class PostRegistrationController extends AbstractController
{
    public function execute()
    {
        $resource = new RegistrationResource();

        $isExist = $resource->checkLogin($_POST['login']);
        if ($isExist) {
            SessionModel::getInstance()->setError('Логин уже занят');
            $this->redirect('registration');
        } else {
            $resource->executeQuery(
                $_POST['login'],
                $_POST['password'],
                $_POST['name'],
                $_POST['surname']
            );
            $this->redirect('login');
        }
    }
}