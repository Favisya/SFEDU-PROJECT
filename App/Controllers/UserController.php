<?php

namespace App\Controllers;

use App\Models\Resource\ProfileResource;

class UserController extends AbstractController
{
    public function execute()
    {
        $resource = new ProfileResource();
        $userModel = $resource->getUserInfo($this->getParam('id'));
        $this->commonExecute('user', $userModel, 'UserBlock');
    }
}
