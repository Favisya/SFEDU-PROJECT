<?php

namespace App\Models;

use App\Blocks\EmailBlock;
use App\Models\Resource\Environment;
use GuzzleHttp;
use SendinBlue\Client;

class Mailer
{
    private $apiInstance;
    private $template;
    private $user;
    private $env;

    public function __construct(string $name, string $template)
    {
        $env = new Environment();
        $this->env = $env;

        $config = Client\Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            $env->getMailerKey()
        );

        $this->apiInstance = new Client\Api\TransactionalEmailsApi(
            new GuzzleHttp\Client(),
            $config
        );

        $block = new EmailBlock();
        $block->setTemplate($template);

        $user = new UserModel();
        $user->setData(['name' => $name]);
        $block->setUser($user);

        $this->user = $user;

        $this->template = $block->getHtml();
    }

    public function sendEmail(string $email)
    {
        $sendSmtpEmail = new Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Notification';
        $sendSmtpEmail['htmlContent'] = $this->template;
        $sendSmtpEmail['sender'] = ['name' => 'Admin group of Super Books', 'email' => $this->env->getEmail()];
        $sendSmtpEmail['to'] = [
            ['email' => $email, 'name' => $this->user->getName()]
        ];

        try {
            $this->apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            $logger = new LoggerModel();
            $logger->printError($e);
        }
    }
}
