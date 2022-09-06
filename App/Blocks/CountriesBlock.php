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

        $data = [];
        while ($row = $stmt->fetch())
        {
            $temp['country'] = $row['name'];
            $temp['id']      = $row['id'];

            $data[] = $temp;
        }

        return $data;
    }
}