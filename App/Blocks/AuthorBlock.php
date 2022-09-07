<?php

namespace App\Blocks;

use App\Database\Database;

class AuthorBlock extends BlockAbstract
{
    protected $template = 'author';

    public function getData(): array
    {
        $db = Database::getInstance()->cONnectDB();

        $query = 'SELECT * from authors WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$_GET['id']]);

        return $stmt->fetch();
    }
}
