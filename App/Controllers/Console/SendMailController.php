<?php

namespace App\Controllers\Console;

use App\Models\Mailer;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $arguments = $this->getArguments();
        $email    = array_shift($arguments);
        $name     = array_shift($arguments);
        $template = array_shift($arguments);

        $model = new Mailer($name, $template);
        $model->sendEmail($email);
    }
}
