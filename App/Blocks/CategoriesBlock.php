<?php

namespace App\Blocks;

use App\Database\Database;

class CategoriesBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'categories';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $query = 'SELECT * FROM categories;';

        $db   = Database::getInstance()->getConnection();
        $stmt = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}
