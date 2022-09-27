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

    public function isLoggedIn()
    {
        $sessionId = SessionModel::getInstance()->getUserId();
        if (!isset($sessionId)) {
            $this->renderLoginButton();
        }
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }
}
