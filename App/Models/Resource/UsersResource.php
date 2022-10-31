<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\UserModel;
use App\Models\UsersModel;

class UsersResource
{
    public function getUsers()
    {
        $query = 'SELECT * FROM users';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $data = [];
        foreach ($stmt->fetchAll() as $user) {
            $item = [
                'name'    => $user['name'],
                'surname' => $user['surname'],
                'email'   => $user['email'],
                'id'      => $user['id'],
            ];
            $userModel = new UserModel();
            $userModel->setData($item);
            $data[] = $userModel;
        }

        $usersModel = new UsersModel();
        $usersModel->setData($data);

        return $usersModel;
    }
}
