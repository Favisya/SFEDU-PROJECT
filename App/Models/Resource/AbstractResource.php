<?php

namespace App\Models\Resource;

use App\Database\Database;

class AbstractResource
{
    public function checkLogin(string $login): bool
    {
        $query = 'SELECT EXISTS(SELECT login FROM users WHERE login = ?)';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        $isExists = $stmt->fetch();
        return reset($isExists);
    }
}