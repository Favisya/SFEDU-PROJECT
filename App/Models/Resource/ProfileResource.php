<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\UserModel;

class ProfileResource extends AbstractResource
{
    public function getUserInfo(int $id)
    {
        $query = 'SELECT name, surname, login, email, id FROM users WHERE id = ?';
        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = $this->di->get(UserModel::class);
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}
