<?php

namespace App\Books\Models\Resource;

use App\Core\Models\Resource\AbstractResource;

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
        $db = $this->database->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login, $password, $name, $surname, $email]);
    }
}
