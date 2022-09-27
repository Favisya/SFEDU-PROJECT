<?php

namespace App\Controllers;

use App\Models\SessionModel;

class LogOutController extends AbstractController
{
    public function execute()
    {
        SessionModel::getInstance()->destroySession();
        $this->redirect('createLogin');
    }
}
