<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AbstractModel;
use App\Models\UserModel;

class ModifyUserResource extends AbstractResource
{
    public function editUser(string $password, string $name, string $surname, string $email, int $id)
    {
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $email    = htmlspecialchars($email);
        $id       = htmlspecialchars($id);

        $password = $this->hashPassword($password);

        $query = 'UPDATE users set password = ?, name = ?, surname = ?, email = ? WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$password, $name, $surname, $email, $id]);
    }

    public function getUser(int $id): AbstractModel
    {
        $query = 'SELECT name, surname, email FROM users WHERE id = ?';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = new UserModel();
        $userModel->setData($stmt->fetch());

        return $userModel;
    }
}
