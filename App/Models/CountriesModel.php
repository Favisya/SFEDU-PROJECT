<?php

namespace App\Models;

use App\Database\Database;

class CountriesModel extends ModelAbstract
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        $this->data = $stmt->fetchAll();
    }

    public function __toString()
    {
        $class = explode('\\', get_class());
        return end($class);
    }
}