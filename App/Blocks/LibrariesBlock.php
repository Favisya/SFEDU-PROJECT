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

        return $stmt->fetchAll();
    }
}
