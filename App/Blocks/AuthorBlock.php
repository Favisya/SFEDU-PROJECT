<?php

namespace App\Blocks;

use App\Database\Database;

class AuthorBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'author';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from authors WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->data = $stmt->fetch();
    }
}
