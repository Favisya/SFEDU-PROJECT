<?php

namespace App\Blocks;

use App\Database\Database;

class LibrariesBlock extends BlockAbstract
{
    protected $template = 'libraries';

    public function getData(): array
    {
        $db    = Database::getInstance()->connectDB();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $data = [];
        while ($row = $stmt->fetch()) {
            $temp['name']    = $row['name'];
            $temp['address'] = $row['address'];
            $temp['id']      = $row['id'];

            $data[] = $temp;
        }

        return $data;
    }
}
