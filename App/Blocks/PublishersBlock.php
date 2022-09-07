<?php

namespace App\Blocks;

use App\Database\Database;

class PublishersBlock extends BlockAbstract
{
    protected $template = 'publishers';

    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        $data = [];
        while ($row = $stmt->fetch()) {
            $temp['publisher'] = $row['name'];
            $temp['id']        = $row['id'];

            $data[] = $temp;
        }

        return $data;
    }
}
