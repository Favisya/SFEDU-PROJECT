<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CategoriesModel;
use App\Models\AbstractModel;

class CategoriesResource
{
    public function getCategories(): AbstractModel
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $categoriesModel = new CategoriesModel();
        $categoriesModel->setData($stmt->fetchAll());

        return $categoriesModel;
    }
}
