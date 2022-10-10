<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Exceptions\CsrfException;
use App\Exceptions\MvcException;
use App\Models\AbstractModel;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

abstract class AbstractController
{
    public function execute()
    {
    }

    public function commonExecute(string $template, AbstractModel $model = null, string $blockName = 'SimpleBlock')
    {
        $method = $blockName;
        $blockName = '\App\Blocks\\' . $blockName;

        $block = new $blockName();
        $block->setTemplate($template);
        if ($model != null) {
            $method = explode('Block', $method);
            $method = reset($method);
            $block->{'set' . "$method"}($model);
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
            if (!$isValid) {
                throw new MvcException('Incorrect input data');
            }
        }
    }

    public function setToken()
    {
        $token = new TokenModel();
        SessionModel::getInstance()->setToken($token->generateToken());
    }

    public function handleToken()
    {
        if (!$this->checkToken($this->getPostParam('token'))) {
            throw new CsrfException('Invalid token');
        }
    }

    public function handleModels(array $models, AbstractBlock $block)
    {
        foreach ($models as $model) {
            $methodName = ucfirst("$model");
            $block->{'set' . $methodName}($model);
        }
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function checkToken(string $token): bool
    {
        return SessionModel::getInstance()->getToken() === $token;
    }
}
