<?php

namespace App\Models;

class SessionModel extends AbstractModel
{
    private static $instance;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new SessionModel();
        }

        return self::$instance;
    }

    public function runSession()
    {
        session_save_path(APP_ROOT . '/App/var/Sessions');
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
}