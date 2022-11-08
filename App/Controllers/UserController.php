<?php

namespace App\Controllers;

use App\Models\Resource\ProfileResource;

class UserController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(ProfileResource::class);
        $userModel = $resource->getUserInfo($this->getParam('id'));
        $this->renderPage('user', $userModel, 'UserBlock');
    }
}
