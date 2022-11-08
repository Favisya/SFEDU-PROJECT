<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Exceptions\CsrfException;
use App\Exceptions\MvcException;
use App\Models\AbstractModel;
use App\Models\Resource\AbstractResource;
use App\Models\Resource\AuthorResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;
use Laminas\Di\Di;

abstract class AbstractController
{
    protected $di;
    protected $resource;
    protected $model;
    protected $block;
    protected $session;

    public function __construct(
        Di $di,
        AbstractResource $resource = null,
        AbstractBlock $block = null,
        AbstractModel $model = null,
        SessionModel $session = null
    ) {
        $this->di = $di;
        $this->resource = $resource;
        $this->block = $block;
        $this->model = $model;
        $this->session = $session;
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
        $environment = $this->di->get(Environment::class);
        header("Location: " . $environment->getUri() . $path);
    }

    public function isLoggedIn(): bool
    {
        $session = $this->di->get(SessionModel::class);
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
        $token = $this->di->get(TokenModel::class);
        $session = $this->di->get(SessionModel::class);
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
        $session = $this->di->get(SessionModel::class);
        return $session->getToken() === $token;
    }
}
