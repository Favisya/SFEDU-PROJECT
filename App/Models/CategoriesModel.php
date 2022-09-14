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

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function executeQuery()
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }

    public function __toString()
    {
        $class = explode('\\', get_class());
        return $class = lcfirst(end($class));
    }
}
