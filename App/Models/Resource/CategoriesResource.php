<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CategoriesModel;
use App\Models\AbstractModel;

class CategoriesResource extends AbstractResource
{
    public function getCategories(): AbstractModel
    {
        $query = 'SELECT * FROM categories;';

        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $stmt = $db->query($query);

        $categoriesModel = $this->di->get(CategoriesModel::class);
        $categoriesModel->setData($stmt->fetchAll());

        return $categoriesModel;
    }
}
