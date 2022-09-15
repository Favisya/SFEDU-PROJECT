<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorsModel;

class AuthorsResource
{
    public function executeQuery(): AuthorsModel
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        $authorsModel = new AuthorsModel();
        $authorsModel->setData($stmt->fetchAll());

        return $authorsModel;
    }
}
