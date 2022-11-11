<?php

namespace App\Blocks;

use App\Models\SessionModel;
use Laminas\Di\Di;

abstract class AbstractBlock
{
    protected $template;
    protected $session;

    public function __construct(SessionModel $session)
    {
        $this->session = $session;
    }

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function isLoggedIn(): bool
    {
        $sessionId = $this->session;
        $sessionId = $sessionId->getUserId();
        return isset($sessionId);
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function getToken(): string
    {
        $session = $this->session;
        return $session->getToken();
    }

    public function renderToken(): void
    {
        require_once APP_ROOT . '/App/templates/formToken.phtml';
    }

    public function secureText(string $data)
    {
        return htmlspecialchars($data);
    }

    public function getHtml()
    {
        ob_start();
        $this->render();
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }


    private function renderLoginButton()
    {
        require_once APP_ROOT . '/App/templates/loginButton.phtml';
    }
}
