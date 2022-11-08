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

        $model = $this->di->get(
            Mailer::class,
            [
                'name'     => $name,
                'template' => $template,
            ]
        );
        $model->sendEmail($email);
    }
}
