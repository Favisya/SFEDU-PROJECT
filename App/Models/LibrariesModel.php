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

    public function setData($data)
    {
        $this->data = $data;
    }

    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }
}
