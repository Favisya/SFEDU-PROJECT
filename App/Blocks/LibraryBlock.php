<?php

namespace App\Blocks;

use App\Database\Database;

class LibraryBlock extends BlockAbstract
{
    protected $template = 'library';

    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        $query = 'SELECT * from libraries WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$_GET['id']]);

        return $stmt->fetch();
    }
}
