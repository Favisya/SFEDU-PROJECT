<?php

namespace App\Models\Resource;

use App\Database\Database;

class RegistrationResource extends AbstractResource
{
    public function createUser(string $login, string $password, string $name, string $surname, string $email)
    {
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);
        $email    = htmlspecialchars($email);

        $password = $this->hashPassword($password);

        $query = 'INSERT INTO users (login, password, name, surname, email) VALUES (?, ?, ?, ?, ?)';
        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login, $password, $name, $surname, $email]);
    }
}
