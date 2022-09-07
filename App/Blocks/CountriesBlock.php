<?php

namespace App\Blocks;

use App\Database\Database;

class CountriesBlock extends BlockAbstract
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
}
