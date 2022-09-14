<?php

namespace App\Models\Resource;

use App\Database\Database;

class LibrariesResource
{
    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }
}
