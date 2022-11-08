<?php

namespace App\Controllers;

use App\Models\SessionModel;

class LogOutController extends AbstractController
{
    public function execute()
    {
        $session = $this->di->get(SessionModel::class);
        $session->destroySession();
        $this->redirect('createLogin');
    }
}
