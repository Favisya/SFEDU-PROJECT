<?php

namespace App\Controllers;

use App\Models\Resource\RegistrationResource;
use App\Models\SessionModel;

class PostRegistrationController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['surname', 'login', 'name']);

        $resource = $this->di->get(RegistrationResource::class);

        $isExist = $resource->checkLogin($this->getPostParam('login'));
        if ($isExist) {
            $session = $this->di->get(SessionModel::class);
            $session->setError('Логин уже занят');
            $this->redirect('registration');
        } else {
            $resource->createUser(
                $this->getPostParam('login'),
                $this->getPostParam('password'),
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email')
            );
            $this->redirect('login');
        }
    }
}
