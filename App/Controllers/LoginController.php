<?php

namespace App\Controllers;

class LoginController extends AbstractController
{
    public function execute()
    {
        $this->setToken();

        if ($this->isLoggedIn()) {
            $this->redirect('profile');
        }

        $this->renderPage('login', $this->block, $this->session);
    }
}
