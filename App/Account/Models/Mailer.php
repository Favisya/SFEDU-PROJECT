<?php

namespace App\Account\Models;

use SendinBlue\Client;
use App\Core\Blocks\EmailBlock;
use App\Core\Models\Resource\Environment;
use App\Core\Models\AbstractModel;

class Mailer extends AbstractModel
{
    private $user;
    private $block;
    private $logger;
    private $template;
    private $smtpEmail;
    private $environment;
    private $apiInstance;

    public function __construct(
        string $name,
        string $template,
        UserModel $user,
        EmailBlock $block,
        LoggerModel $logger,
        Environment $environment,
        Client\Model\SendSmtpEmail $smtpEmail,
        Client\Api\TransactionalEmailsApi $apiInstance
    ) {
        $this->user        = $user;
        $this->block       = $block;
        $this->logger      = $logger;
        $this->smtpEmail   = $smtpEmail;
        $this->environment = $environment;
        $this->apiInstance = $apiInstance;

        $this->block->setTemplate($template);
        $this->user->setData(['name' => $name]);
        $this->block->setUser($user);
        $this->template = $this->block->getHtml();
    }

    public function sendEmail(string $email)
    {
        $this->smtpEmail['subject'] = 'Notification';
        $this->smtpEmail['htmlContent'] = $this->template;
        $this->smtpEmail['sender'] = [
            'name' => 'Admin group of Super Books',
            'email' => $this->environment->getEmail()
        ];
        $this->smtpEmail['to'] = [
            ['email' => $email, 'name' => $this->user->getName()]
        ];

        try {
            $this->apiInstance->sendTransacEmail($this->smtpEmail);
        } catch (\Exception $e) {
            $this->logger->printError($e);
        }
    }
}
