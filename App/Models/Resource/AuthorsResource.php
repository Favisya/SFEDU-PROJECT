<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorsModel;
use App\Models\ModelAbstract;

class AuthorsResource
{
    public function executeQuery(): ModelAbstract
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        $authorsModel = new AuthorsModel();
        $authorsModel->setData($stmt->fetchAll());

        return $authorsModel;
    }
}
