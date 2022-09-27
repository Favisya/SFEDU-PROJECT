<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AbstractModel;
use App\Models\UserModel;

class ModifyUserResource extends AbstractResource
{
    public function executeQuery(string $password, string $name, string $surname, int $id)
    {
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $id       = htmlspecialchars($id);

        $password = $this->hashPassword($password);

        $query = 'UPDATE users set password = ?, name = ?, surname = ? WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$password, $name, $surname, $id]);
    }

    public function getUser(int $id): AbstractModel
    {
        $query = 'SELECT name, surname FROM users WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = new UserModel();
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}
