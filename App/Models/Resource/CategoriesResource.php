<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CategoriesModel;

class CategoriesResource
{
    public function executeQuery()
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $categoriesModel = new CategoriesModel();
        $categoriesModel->setData($stmt->fetchAll());

        return $categoriesModel;
    }
}
