<?php

namespace App\Controllers\Console;

use App\Models\Resource\Mailer;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $model = new Mailer();
        $model->sendEmail($this->getArgument());
    }
}
