<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\UserModel;

class ProfileResource
{
    public function executeQuery(int $id)
    {
        $query = 'SELECT name, surname, login FROM users WHERE id = ?';
        $db    = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = new UserModel();
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}
