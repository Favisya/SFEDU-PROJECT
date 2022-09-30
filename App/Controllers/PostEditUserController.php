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
        $resource->executeQuery(
            $this->getPostParam('password'),
            $this->getPostParam('name'),
            $this->getPostParam('surname'),
            SessionModel::getInstance()->getUserId()
        );

        $this->redirect('profile');
    }
}
