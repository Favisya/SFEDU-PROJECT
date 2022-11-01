<?php

namespace App\Controllers;

use App\Models\Mailer;
use App\Models\Resource\ProfileResource;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $resource = new ProfileResource();
        $user  = $resource->getUserInfo($this->getParam('id'));

        $model = new Mailer($user->getName(), $this->getParam('template'));
        $model->sendEmail($user->getEmail());
        $this->redirect('users');
    }
}
