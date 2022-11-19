<?php

namespace App\Account\Models\Resource;

use App\Core\Models\AbstractModel;
use App\Core\Models\Resource\AbstractResource;
use App\Account\Models\UserModel;
use App\Account\Models\UsersModel;

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

    public function createUser(string $login, string $password, string $name, string $surname, string $email)
    {
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $email    = htmlspecialchars($email);

        $password = $this->hashPassword($password);

        $query = 'INSERT INTO users (login, password, name, surname, email) VALUES (?, ?, ?, ?, ?)';
        $db = $this->database->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login, $password, $name, $surname, $email]);
    }

    public function getUserInfo(int $id)
    {
        $query = 'SELECT name, surname, login, email, id FROM users WHERE id = ?';
        $db = $this->database->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = $this->di->get(UserModel::class);
        $userModel->setData($stmt->fetch());

        return $userModel;
    }

    public function editUser(string $password, string $name, string $surname, string $email, int $id)
    {
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $email    = htmlspecialchars($email);
        $id       = htmlspecialchars($id);

        $password = $this->hashPassword($password);

        $query = 'UPDATE users set password = ?, name = ?, surname = ?, email = ? WHERE id = ?';
        $db = $this->database->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$password, $name, $surname, $email, $id]);
    }

    public function getUser(int $id): AbstractModel
    {
        $query = 'SELECT name, surname, email FROM users WHERE id = ?';
        $db = $this->database->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $userModel = $this->di->get(UserModel::class);
        $userModel->setData($stmt->fetch());

        return $userModel;
    }

    public function getUserByLogin(string $login)
    {
        $login = htmlspecialchars($login);

        $db = $this->database->getConnection();
        $query = 'SELECT password, id FROM users WHERE login = ?';

        $stmt = $db->prepare($query);
        $stmt->execute([$login]);

        return $stmt->fetch();
    }
}
