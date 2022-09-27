<?php

namespace App\Controllers;

use App\Models\Resource\RegistrationResource;
use App\Models\SessionModel;
use App\Models\UserModel;

class RegistrationController extends AbstractController
{
    public function execute()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('profile');
        }
        $this->commonExecute('registration', SessionModel::getInstance());
    }
}
