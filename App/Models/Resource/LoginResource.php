<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\SessionModel;

class LoginResource
{
    public function executeQuery(string $login, string $password): bool
    {
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        $query = 'SELECT password, id FROM users WHERE login = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        $data = $stmt->fetch();

        $verify = password_verify($password, $data['password']);
        if (!$verify) {
            return false;
        }

        $sessionModel = SessionModel::getInstance();
        $sessionModel->runSession();
        $sessionModel->setData($data);

        return true;
    }
}
