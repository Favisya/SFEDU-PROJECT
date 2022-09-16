<?php

namespace App\Models;

class BooksModel extends AbstractModel
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }
}
