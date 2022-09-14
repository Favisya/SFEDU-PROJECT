<?php

namespace App\Models\Resource;

use App\Database\Database;

class AuthorsResource
{
    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }
}
