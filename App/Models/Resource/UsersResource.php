<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\UserModel;
use App\Models\UsersModel;

class UsersResource extends AbstractResource
{
    public function getUsers()
    {
        $query = 'SELECT * FROM users';
        $db = $this->database->getConnection();

        $stmt = $db->query($query);

        $data = [];
        foreach ($stmt->fetchAll() as $user) {
            $item = [
                'name'    => $user['name'],
                'surname' => $user['surname'],
                'email'   => $user['email'],
                'id'      => $user['id'],
            ];
            $userModel = $this->di->newInstance(UserModel::class);
            $userModel->setData($item);
            $data[] = $userModel;
        }

        $usersModel = $this->di->get(UsersModel::class);
        $usersModel->setData($data);

        return $usersModel;
    }
}
