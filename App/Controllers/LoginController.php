<?php

namespace App\Controllers;

use App\Models\Resource\LoginResource;
use App\Models\SessionModel;

class LoginController extends AbstractController
{
    public function execute()
    {
        if ($this->checkSession()) {
            $this->redirect('profile');
        }

        $this->commonExecute('login', SessionModel::getInstance());
    }
}