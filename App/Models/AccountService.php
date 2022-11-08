<?php

namespace App\Models;

use App\Models\Resource\AbstractResource;
use Laminas\Di\Di;

class AccountService
{
    private $resource;
    private $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function authenticate($login, $password): bool
    {
        $user = $this->resource->getUserByLogin($login);
        if (!$this->isPasswordValid($user['password'], $password)) {
            return false;
        }

        $this->setUserToSession($user);
        return true;
    }

    public function setResource(AbstractResource $resource): void
    {
        $this->resource = $resource;
    }


    protected function isPasswordValid(string $hash, string $password): bool
    {
        return password_verify($password, $hash);
    }


    private function setUserToSession(array $user): void
    {
        $sessionModel = $this->di->get(SessionModel::class);
        $sessionModel->setUserData($user);
    }
}
