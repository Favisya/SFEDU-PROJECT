<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\UserModel;

class ProfileResource
{
    public function getUserInfo(int $id)
    {
        $query = 'SELECT name, surname, login, email, id FROM users WHERE id = ?';
        $db    = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = new UserModel();
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}
