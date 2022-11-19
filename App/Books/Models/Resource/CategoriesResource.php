<?php

namespace App\Books\Models\Resource;

use App\Core\Models\Resource\AbstractResource;
use App\Books\Models\CategoriesModel;
use App\Core\Models\AbstractModel;

class CategoriesResource extends AbstractResource
{
    public function getCategories(): AbstractModel
    {
        $query = 'SELECT * FROM categories;';

        $db = $this->database->getConnection();

        $stmt = $db->query($query);

        $categoriesModel = $this->di->get(CategoriesModel::class);
        $categoriesModel->setData($stmt->fetchAll());

        return $categoriesModel;
    }
}
