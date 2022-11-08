<?php

namespace App\Models\Resource;

use App\Database\Database;
use Laminas\Di\Di;

abstract class AbstractResource
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function checkLogin(string $login): bool
    {
        $query = 'SELECT EXISTS(SELECT login FROM users WHERE login = ?)';
        $db = $this->di->get(Database::class);
        $db->getConnection();

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
