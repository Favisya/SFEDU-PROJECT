<?php

namespace App\Models;

use App\Database\Database;

class PublishersModel extends ModelAbstract
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        return $stmt->fetchAll();
    }

    public function __toString()
    {
        $class = explode('\\', get_class());
        return $class = lcfirst(end($class));
    }
}
