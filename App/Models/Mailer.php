<?php

namespace App\Models;

use App\Blocks\EmailBlock;
use App\Models\Resource\Environment;
use GuzzleHttp;
use Laminas\Di\Di;
use SendinBlue\Client;

class Mailer extends AbstractModel
{
    private $apiInstance;
    private $template;
    private $user;
    private $env;

    public function __construct(string $name, string $template, Di $di)
    {
        parent::__construct($di);
        $this->env = $this->di->get(Environment::class);

        $config = Client\Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            $this->env->getMailerKey()
        );

        $this->apiInstance = $this->di->get(
            Client\Api\TransactionalEmailsApi::class,
            [
                'client' => $this->di->get(GuzzleHttp\Client::class),
                'config' => $config,
            ]
        );

        $block = $this->di->get(EmailBlock::class);
        $block->setTemplate($template);

        $user = $this->di->get(UserModel::class);
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
            $logger = $this->di->get(LoggerModel::class);
            $logger->printError($e);
        }
    }
}
