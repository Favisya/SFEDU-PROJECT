<?php

namespace App\Controllers;

use App\Models\Mailer;
use App\Models\Resource\AbstractResource;
use App\Models\Resource\Environment;
use App\Models\Resource\ProfileResource;
use App\Models\SessionModel;
use App\Models\TokenModel;
use Laminas\Di\Di;

class SendMailController extends AbstractController
{
    private $di;

    public function __construct(
        Di $di,
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        ProfileResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
        $this->di = $di;
    }

    public function execute()
    {
        $user = $this->resource->getUserInfo($this->getParam('id'));
        $email = $user->getEmail();

        $model = $this->di->get(
            Mailer::class,
            [
                'name'     => $user->getName(),
                'template' => $this->getParam('template'),
            ]
        );
        $model->sendEmail($email);
        $this->redirect('users');
    }
}
