<?php

namespace App\Controllers\Console;

use App\Models\Mailer;

class SendMailController extends AbstractController
{
    public function execute()
    {
        $arguments = $this->getArgument();
        $model = new Mailer(end($arguments));
        $model->sendEmail(reset($arguments));
    }
}
