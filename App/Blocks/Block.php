<?php

namespace App\Blocks;

use App\Models\AbstractModel;
use App\Models\SessionModel;

class Block
{
    protected $template;
    protected $models = [];

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function setModel(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getAuthor()
    {
        return $this->models['author'];
    }

    public function getAuthors()
    {
        return $this->models['authors'];
    }

    public function getBook()
    {
        return $this->models['book'];
    }

    public function getBooks()
    {
        return $this->models['books'];
    }

    public function getLibrary()
    {
        return $this->models['library'];
    }

    public function getLibraries()
    {
        return $this->models['libraries'];
    }

    public function getPublisher()
    {
        return $this->models['publisher'];
    }

    public function getPublishers()
    {
        return $this->models['publishers'];
    }

    public function getUser()
    {
        return $this->models['user'];
    }

    public function getCountries()
    {
        return $this->models['countries'];
    }

    public function getCategories()
    {
        return $this->models['categories'];
    }

    public function getSession()
    {
        return $this->models['session'];
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
        return $this->models;
    }

    private function renderLoginButton()
    {
        require_once APP_ROOT . '/App/templates/loginButton.phtml';
    }
}
