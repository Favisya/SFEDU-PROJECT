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

    private function renderLoginButton()
    {
        require_once APP_ROOT . '/App/templates/loginButton.phtml';
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
}
