<?php

namespace App\Models;

class LibraryModel extends AbstractModel
{
    private $data  = [];
    private $books = [];

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function getBooks(): ?array
    {
        return $this->books ?? null;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setBooks($data)
    {
        $this->books = $data;
    }
}
