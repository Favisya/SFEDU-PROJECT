<?php

namespace App\Account\Controllers;

use App\Account\Models\Mailer;
use App\Account\Models\Resource\UsersResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;
use Laminas\Di\Di;

class SendMailController extends AbstractController
{
    private $di;

    public function __construct(
        Di $di,
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UsersResource $resource
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
