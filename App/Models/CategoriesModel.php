<?php

namespace App\Models;

use App\Database\Database;

class CategoriesModel extends ModelAbstract
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}