<?php

namespace App\Blocks;

use App\Database\Database;

class AuthorsBlock extends BlockAbstract
{
    protected $template = 'authors';

    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        $query = 'SELECT * from authors;';
        $stmt  = $db->query($query);

        return $stmt->fetchAll();
    }
}
