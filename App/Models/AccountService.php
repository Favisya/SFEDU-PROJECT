<?php

namespace App\Models;

class AccountService extends AbstractService
{
    public function __construct(SessionModel $session)
    {
        $this->session = $session;
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

    protected function isPasswordValid(string $hash, string $password): bool
    {
        return password_verify($password, $hash);
    }


    private function setUserToSession(array $user): void
    {
        $sessionModel = $this->session;
        $sessionModel->setUserData($user);
    }
}
