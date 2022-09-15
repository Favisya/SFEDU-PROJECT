<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CategoriesModel;
use App\Models\ModelAbstract;

class CategoriesResource
{
    public function executeQuery(): ModelAbstract
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $categoriesModel = new CategoriesModel();
        $categoriesModel->setData($stmt->fetchAll());

        return $categoriesModel;
    }
}
