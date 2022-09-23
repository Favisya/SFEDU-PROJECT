<?php

namespace App\Controllers;

use App\Models\Resource\RegistrationResource;
use App\Models\UserModel;

class RegistrationController extends AbstractController
{
    public function execute()
    {
        if ($this->checkSession())
        {
            $this->redirect('profile');
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $userModel = new UserModel();
            $this->commonExecute('registration', $userModel);
        } else {
            $resource = new RegistrationResource();
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