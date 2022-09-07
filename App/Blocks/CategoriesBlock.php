<?php

namespace App\Blocks;

use App\Database\Database;

class CategoriesBlock extends BlockAbstract
{
    protected $template = 'categories';

    public function getData(): array
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->connectDB();
        $stmt = $db->query($query);

        return $stmt->fetchAll();
    }
}
