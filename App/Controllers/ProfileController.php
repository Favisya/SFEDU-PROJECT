<?php

namespace App\Controllers;

use App\Models\Resource\ProfileResource;
use App\Models\SessionModel;

class ProfileController extends AbstractController
{
    public function execute()
    {
        $sessionModel = SessionModel::getInstance();
        $resource = new ProfileResource();
        $userModel = $resource->executeQuery($_SESSION['id']);
        $this->commonExecute('profile', $userModel);
    }
}