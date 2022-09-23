<?php

namespace App\Controllers;

use App\Models\Resource\ModifyUserResource;

class ModifyUserController extends AbstractController
{
    public function execute()
    {
        $resource = new ModifyUserResource();
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $userModel = $resource->getUser($_SESSION['id']);
            $this->commonExecute('registration', $userModel);
        } else {
            $resource->executeQuery(
                $_POST['login'],
                $_POST['password'],
                $_POST['name'],
                $_POST['surname'],
                $_SESSION['id']
            );

            $this->redirect('profile');
        }
    }
}
