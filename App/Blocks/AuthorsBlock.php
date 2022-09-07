<?php

namespace App\Blocks;

use App\Database\Database;

class AuthorsBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'authors';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from authors;';
        $stmt  = $db->query($query);

        $this->data = $stmt->fetchAll();
    }
}
