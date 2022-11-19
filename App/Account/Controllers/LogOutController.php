<?php

namespace App\Account\Controllers;
use App\Core\Controllers\AbstractController;

class LogOutController extends AbstractController
{
    public function execute()
    {
        $session = $this->session;
        $session->destroySession();
        $this->redirect('login');
    }
}
