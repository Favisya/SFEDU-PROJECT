<?php

namespace App\Controllers;

use App\Models\Resource\LoginResource;
use App\Models\SessionModel;

class LoginController extends AbstractController
{
    public function execute()
    {
        $this->setToken();

        if ($this->isLoggedIn()) {
            $this->redirect('profile');
        }

        $this->renderPage('login', SessionModel::getInstance(), 'SessionBlock');
    }
}
