<?php

namespace App\Blocks;

use App\Database\Database;

class LibraryBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'library';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from libraries WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$_GET['id']]);

        $this->data = $stmt->fetch();
    }
}
