<?php

namespace App\Models\Resource;

use App\Blocks\UserBlock;
use App\Models\UserModel;
use App\Models\LoggerModel;
use GuzzleHttp;
use SendinBlue\Client;

class Mailer
{
    private $apiInstance;
    private $template;

    public function __construct(UserModel $user = null)
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

        $block = new UserBlock();
        $block->setTemplate('email');
        if ($user != null) {
            $block->setUser($user);
        } else {
            $user = new UserModel();
            $user->setData(['name' => 'пользователь', 'surname' => 'Дорогой']);
            $block->setUser($user);
        }

        ob_start();
        $block->renderEmail();
        $this->template = ob_get_contents();
        ob_end_clean();
    }

    public function sendEmail(string $email)
    {
        $sendSmtpEmail = new Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Notification';
        $sendSmtpEmail['htmlContent'] = $this->template;
        $sendSmtpEmail['sender'] = array('name' => 'Admin group of Super Books', 'email' => 'Super@Book.com');
        $sendSmtpEmail['to'] = array(
            array('email' => $email, 'name' => 'Dear user')
        );

        try {
            $this->apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            $logger = new LoggerModel();
            $logger->printError($e);
        }
    }
}
