<?php

namespace App\Models;

class SessionModel extends AbstractModel
{
    private static $instance;

    public function __construct()
    {
        session_save_path(APP_ROOT . '/App/var/Sessions');
    }

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new SessionModel();
        }

        return self::$instance;
    }

    public function runSession()
    {
        session_start();
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function setData(array $data)
    {
        $_SESSION['id'] = $data['id'];
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
        return $err;
    }

    public function __toString()
    {
        return 'session';
    }
}
