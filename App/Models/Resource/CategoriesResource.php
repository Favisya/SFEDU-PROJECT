<?php

namespace App\Models\Resource;

use App\Database\Database;

class CategoriesResource
{
    public function executeQuery()
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }
}
