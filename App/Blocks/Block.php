<?php

namespace App\Blocks;

use App\Models\AbstractModel;
use App\Models\SessionModel;

class Block
{
    protected $template;
    protected $model = [];

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function setModel(AbstractModel $model)
    {
        $this->model = $model;
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

    public function getModel()
    {
        return $this->model;
    }

    private function renderLoginButton()
    {
        require_once APP_ROOT . '/App/templates/loginButton.phtml';
    }
}
