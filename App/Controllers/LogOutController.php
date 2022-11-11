<?php

namespace App\Controllers;

class LogOutController extends AbstractController
{
    public function execute()
    {
        $session = $this->session;
        $session->destroySession();
        $this->redirect('createLogin');
    }
}
