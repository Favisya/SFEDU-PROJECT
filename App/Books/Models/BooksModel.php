<?php

namespace App\Books\Models;

use App\Core\Models\AbstractModel;

class BooksModel extends AbstractModel
{
    private $data = [];

    public function getList(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return 'books';
    }
}
