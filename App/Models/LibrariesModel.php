<?php

namespace App\Models;

use App\Database\Database;

class LibrariesModel extends ModelAbstract
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}