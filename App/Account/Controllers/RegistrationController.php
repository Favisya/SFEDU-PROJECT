<?php

namespace App\Account\Controllers;

use App\Core\Controllers\AbstractController;

class RegistrationController extends AbstractController
{
    public function execute()
    {
        $this->setToken();

        if ($this->isLoggedIn()) {
            $this->redirect('profile');
        }

        $this->renderPage('registration', $this->block, $this->session);
    }
}
