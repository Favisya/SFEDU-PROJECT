<?php

namespace App\Blocks;

use App\Database\Database;

class LibrariesBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'libraries';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}
