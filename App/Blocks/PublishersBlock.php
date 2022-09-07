<?php

namespace App\Blocks;

use App\Database\Database;

class PublishersBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'publishers';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}
