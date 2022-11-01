<?php

namespace App\Controllers\Console;

use App\Models\Mailer;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $arguments = $this->getArguments();
        $model = new Mailer($arguments[SECOND_ARG], $arguments[THIRD_ARG]);
        $model->sendEmail($arguments[FIRST_ARG]);
    }
}
