<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\SessionModel;

class RegistrationResource
{
    public function executeQuery(string $login, string $password, string $name, string $surname)
    {
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $name     = htmlspecialchars($name);
        $surname  = htmlspecialchars($surname);

        $password = password_hash($password, 1);

        $query = 'INSERT INTO users (login, password, name, surname) VALUES (?, ?, ?, ?)';
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare($query);
        $stmt->execute([$login, $password, $name, $surname]);
    }
}
