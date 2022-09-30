<?php

namespace App\Controllers;

use App\Exceptions\CSRFException;
use App\Exceptions\MvcException;
use App\Models\AbstractModel;
use App\Models\Resource\Environment;
use App\Models\SessionModel;

abstract class AbstractController
{
    public function execute()
    {
    }

    public function commonExecute(string $template, AbstractModel $model = null, string $blockName = 'Block')
    {
        $blockName = '\App\Blocks\\' . $blockName;

        $block = new $blockName();
        $block->setTemplate($template);
        if ($model != null) {
            $block->setModel($model);
        }

        $block->render();
    }

    public function getPostParam(string $key)
    {
        return $_POST[$key] ?? null;
    }

    public function getParam(string $key)
    {
        return $_GET[$key] ?? null;
    }

    public function redirect(string $path)
    {
        $environment = new Environment();
        header("Location: " . $environment->getUri() . $path);
    }

    public function isLoggedIn(): bool
    {
        $session = SessionModel::getInstance()->getUserId();
        return isset($session);
    }

    public function validateForm(array $keys)
    {
        $patternName = '/^[a-zA-Z0-9 ]*$/';
        foreach ($keys as $key) {
            $isValid = preg_match($patternName, $this->getPostParam($key));
            if ($isValid) {
            } else {
                throw new MvcException('Incorrect input data');
            }
        }
    }

    public function setToken()
    {
        SessionModel::getInstance()->setToken($this->generateToken());
    }

    public function handleToken()
    {
        if (!$this->checkToken($this->getPostParam('token'))) {
            throw new CSRFException('Invalid token');
        }
    }


    private function checkToken(string $token): bool
    {
        return SessionModel::getInstance()->getToken() === $token;
    }

    private function generateToken()
    {
        return hash('sha256', random_bytes(16));
    }
}
