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

        return $stmt->fetchAll();
    }
}
