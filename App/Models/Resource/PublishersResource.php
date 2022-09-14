<?php

namespace App\Models\Resource;

use App\Database\Database;

class PublishersResource
{
    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        return $stmt->fetchAll();
    }
}
