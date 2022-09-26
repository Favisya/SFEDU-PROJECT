<?php

namespace App\Controllers;

use App\Models\Resource\ModifyUserResource;
use App\Models\SessionModel;

class PostEditUserController extends AbstractController
{
    public function execute()
    {
        $resource = new ModifyUserResource();
        $resource->executeQuery(
            $_POST['password'],
            $_POST['name'],
            $_POST['surname'],
            $_SESSION['id']
        );

        $this->redirect('profile');
    }
}
