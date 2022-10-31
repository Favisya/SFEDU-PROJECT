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

    public function __construct(string $name)
    {
        $env = new Environment();
        $config = Client\Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            $env->getMailerKey()
        );

        $this->apiInstance = new Client\Api\TransactionalEmailsApi(
            new GuzzleHttp\Client(),
            $config
        );

        $block = new EmailBlock();
        $block->setTemplate('email');

        $user = new UserModel();
        $user->setData(['name' => $name]);
        $block->setUser($user);

        $this->template = $block->render();
    }

    public function sendEmail(string $email)
    {
        $sendSmtpEmail = new Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Notification';
        $sendSmtpEmail['htmlContent'] = $this->template;
        $sendSmtpEmail['sender'] = ['name' => 'Admin group of Super Books', 'email' => 'Super@Book.com'];
        $sendSmtpEmail['to'] = [
            ['email' => $email, 'name' => 'Dear user']
        ];

        try {
            $this->apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            $logger = new LoggerModel();
            $logger->printError($e);
        }
    }
}
