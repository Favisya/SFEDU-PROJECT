<?php

namespace App\Models\Resource;

use App\Database\Database;

class CountriesResource
{
    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        return $stmt->fetchAll();
    }
}
