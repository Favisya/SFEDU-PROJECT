<?php

namespace App\Core\Models;

class SessionModel extends AbstractModel
{
    public function __construct()
    {
        session_save_path(APP_ROOT . '/var/Sessions');
    }

    public function runSession()
    {
        session_start();
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function setUserData(array $data)
    {
        $_SESSION['user']['id'] = $data['id'];
    }

    public function getUserId(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }

    public function setError(string $error)
    {
        $_SESSION['error'] = $error;
    }

    public function getError(): ?string
    {
        $err = null;
        if (isset($_SESSION['error'])) {
            $err = $_SESSION['error'];
            $this->destroySession();
        }
        return $err ?? null;
    }

    public function getToken(): string
    {
        return $_SESSION['user']['token'];
    }

    public function __toString()
    {
        return 'session';
    }


    public function setToken(string $token)
    {
        $_SESSION['user']['token'] = $token;
    }
}
