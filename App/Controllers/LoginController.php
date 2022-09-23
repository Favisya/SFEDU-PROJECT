<?php

namespace App\Controllers;

use App\Models\Resource\LoginResource;

class LoginController extends AbstractController
{
    public function execute()
    {
        if ($this->checkSession())
        {
            $this->redirect('profile');
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $this->commonExecute('login');
        } else {
            $resource = new LoginResource();
            $verify = $resource->executeQuery($_POST['login'], $_POST['password']);

            if (!$verify) {
                $this->redirect('createLogin');
            }
            $this->redirect('profile');
        }
    }
}