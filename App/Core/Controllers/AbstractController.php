<?php

namespace App\Core\Controllers;

use App\Core\Blocks\AbstractBlock;
use App\Core\Exceptions\CsrfException;
use App\Core\Exceptions\MvcException;
use App\Core\Models\AbstractModel;
use App\Core\Models\AbstractService;
use App\Core\Models\Resource\AbstractResource;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

abstract class AbstractController
{
    protected $resource;
    protected $service;
    protected $model;
    protected $block;
    protected $tokenModel;
    protected $session;
    protected $environment;

    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        AbstractResource $resource = null,
        AbstractBlock $block       = null,
        AbstractService $service   = null,
        AbstractModel $model       = null
    ) {
        $this->resource     = $resource;
        $this->service      = $service;
        $this->block        = $block;
        $this->model        = $model;
        $this->session      = $session;
        $this->environment  = $environment;
        $this->tokenModel   = $tokenModel;
    }

    abstract public function execute();

    public function renderPage(string $template, AbstractBlock $block, AbstractModel $model = null)
    {
        $method = explode('\\', get_class($block));
        $method = end($method);

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
        $environment = $this->environment;
        header("Location: " . $environment->getUri() . $path);
    }

    public function isLoggedIn(): bool
    {
        $session = $this->session;
        $session = $session->getUserId();

        return isset($session);
    }

    public function validateForm(array $keys): void
    {
        $patternName = '/^[a-zA-Z0-9 ]*$/';
        foreach ($keys as $key) {
            $isValid = preg_match($patternName, $this->getPostParam($key));
            if (!$isValid) {
                throw new MvcException('Incorrect input data');
            }
        }
    }

    public function setToken(): void
    {
        $token = $this->tokenModel;
        $session = $this->session;
        $session->setToken($token->generateToken());
    }

    public function handleToken(): void
    {
        if (!$this->checkToken($this->getPostParam('token'))) {
            throw new CsrfException('Invalid token');
        }
    }

    public function handleModels(array $models, AbstractBlock $block): void
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
        $session = $this->session;
        return $session->getToken() === $token;
    }
}
