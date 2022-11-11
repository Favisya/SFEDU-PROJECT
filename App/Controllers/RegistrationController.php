<?php

namespace App\Controllers;

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
