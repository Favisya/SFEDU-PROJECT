<?php

namespace App\Controllers;

use App\Models\Resource\ProfileResource;
use App\Models\SessionModel;

class ProfileController extends AbstractController
{
    public function execute()
    {
        $resource = new ProfileResource();
        $userModel = $resource->getUserInfo(SessionModel::getInstance()->getUserId());
        $this->commonExecute('profile', $userModel);
    }
}
