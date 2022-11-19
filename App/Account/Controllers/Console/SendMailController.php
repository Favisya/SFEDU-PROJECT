<?php

namespace App\Account\Controllers\Console;

use Laminas\Di\Di;
use App\Account\Models\Mailer;
use App\Core\Controllers\Console\AbstractController;

class SendMailController extends AbstractController
{
    private $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

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
