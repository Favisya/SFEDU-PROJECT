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
        $session = $this->di->get(SessionModel::class);

        $resource = $this->di->get(ModifyUserResource::class);
        $resource->editUser(
            $this->getPostParam('password'),
            $this->getPostParam('name'),
            $this->getPostParam('surname'),
            $this->getPostParam('email'),
            $session->getUserId()
        );

        $this->redirect('profile');
    }
}
