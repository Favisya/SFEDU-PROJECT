<?php

namespace App\Models;

use App\Models\Resource\AbstractResource;

class AccountService
{
    private $resource;

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
        $sessionModel = SessionModel::getInstance();
        $sessionModel->setUserData($user);
    }
}
