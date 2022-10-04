<?php

namespace App\Blocks;

use App\Models\AbstractModel;
use App\Models\SessionModel;

abstract class AbstractBlock
{
    protected $template;

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function isLoggedIn(): bool
    {
        $sessionId = SessionModel::getInstance()->getUserId();
        return isset($sessionId);
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function getToken(): string
    {
        return SessionModel::getInstance()->getToken();
    }

    public function renderToken(): void
    {
        require_once APP_ROOT . '/App/templates/formToken.phtml';
    }

    public function toNormalText(string $data)
    {
        return htmlspecialchars($data);
    }

    private function renderLoginButton()
    {
        require_once APP_ROOT . '/App/templates/loginButton.phtml';
    }
}
