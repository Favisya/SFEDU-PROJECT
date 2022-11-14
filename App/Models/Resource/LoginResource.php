<?php

namespace App\Models\Resource;

use App\Database\Database;

class LoginResource extends AbstractResource
{
    public function getUserByLogin(string $login)
    {
        $login = htmlspecialchars($login);

        $db = $this->database->getConnection();
        $query = 'SELECT password, id FROM users WHERE login = ?';

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        return $stmt->fetch();
    }
}
