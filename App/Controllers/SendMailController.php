<?php

namespace App\Controllers;

use App\Models\Resource\Environment;
use App\Models\Resource\Mailer;
use App\Models\Resource\ProfileResource;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $resource = new ProfileResource();
        $user  = $resource->getUserInfo($this->getParam('id'));

        $model = new Mailer($user);
        $model->sendEmail($user->getEmail());
        $this->redirect('users');
    }
}
