<?php

namespace App\Controllers;

use App\Models\Resource\Environment;
use App\Models\Resource\RegistrationResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostRegistrationController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        RegistrationResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['surname', 'login', 'name']);

        $resource = $this->resource;

        $isExist = $resource->checkLogin($this->getPostParam('login'));
        if ($isExist) {
            $session = $this->session;
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
