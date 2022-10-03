<?php

namespace App\Models;

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
