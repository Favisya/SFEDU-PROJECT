<?php

namespace App\Blocks;

use App\Database\Database;

class CountriesBlock extends BlockAbstract
{
    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        return $stmt->fetchAll();
    }
}
