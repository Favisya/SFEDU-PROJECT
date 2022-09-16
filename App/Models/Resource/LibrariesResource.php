<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\LibrariesModel;
use App\Models\AbstractModel;

class LibrariesResource
{
    public function executeQuery(): AbstractModel
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $librariesModel = new LibrariesModel();
        $librariesModel->setData($stmt->fetchAll());

        return $librariesModel;
    }
}
