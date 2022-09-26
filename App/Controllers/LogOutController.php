<?php

namespace App\Controllers;

class LogOutController extends AbstractController
{
    public function execute()
    {
        session_destroy();

        $this->redirect('createLogin');
    }
}
