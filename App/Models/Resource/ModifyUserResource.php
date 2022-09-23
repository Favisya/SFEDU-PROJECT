<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AbstractModel;
use App\Models\UserModel;

class ModifyUserResource
{
    public function executeQuery(string $login, string $password, string $name, string $surname, int $id)
    {
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $id       = htmlspecialchars($id);

        $password = password_hash($password, 1);

        $query = 'UPDATE users set login = ?, password = ?, name = ?, surname = ? WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login, $password, $name, $surname, $id]);
    }

    public function getUser(int $id): AbstractModel
    {
        $query = 'SELECT name, surname, login FROM users WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = new UserModel();
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}