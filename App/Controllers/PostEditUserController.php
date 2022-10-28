<?php

namespace App\Controllers;

use App\Models\Resource\ModifyUserResource;
use App\Models\SessionModel;

class PostEditUserController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['surname', 'name']);

        $resource = new ModifyUserResource();
        $resource->editUser(
            $this->getPostParam('password'),
            $this->getPostParam('name'),
            $this->getPostParam('surname'),
            $this->getPostParam('email'),
            SessionModel::getInstance()->getUserId()
        );

        $this->redirect('profile');
    }
}
