<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\SessionModel;

class LoginResource
{
    public function takePassword(string $login)
    {
        $login = htmlspecialchars($login);

        $query = 'SELECT password, id FROM users WHERE login = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        return $stmt->fetch();
    }
}
