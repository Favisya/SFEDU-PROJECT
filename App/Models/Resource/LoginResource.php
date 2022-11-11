<?php

namespace App\Models\Resource;

use App\Database\Database;

class LoginResource extends AbstractResource
{
    public function getUserByLogin(string $login)
    {
        $login = htmlspecialchars($login);

        $query = 'SELECT password, id FROM users WHERE login = ?';
        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        return $stmt->fetch();
    }
}
