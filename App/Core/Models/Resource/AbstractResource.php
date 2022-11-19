<?php

namespace App\Core\Models\Resource;

use App\Core\Database\Database;
use Laminas\Di\Di;

abstract class AbstractResource
{
    protected $di;
    protected $database;

    public function __construct(Di $di, Database $database)
    {
        $this->di       = $di;
        $this->database = $database;
    }

    public function checkLogin(string $login): bool
    {
        $query = 'SELECT EXISTS(SELECT login FROM users WHERE login = ?)';
        $db = $this->database;
        $db = $db->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        $isExists = $stmt->fetch();
        return reset($isExists);
    }

    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
