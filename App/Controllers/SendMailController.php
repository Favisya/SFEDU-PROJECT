<?php

namespace App\Controllers;

use App\Models\Mailer;
use App\Models\Resource\ProfileResource;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(ProfileResource::class);
        $user  = $resource->getUserInfo($this->getParam('id'));

        $model = $this->di->get(
            Mailer::class,
            [
                'name'     => $user->getName(),
                'template' => $this->getParam('template'),
                'di'       => $this->di,
            ]
        );
        $model->sendEmail($user->getEmail());
        $this->redirect('users');
    }
}
