<?php

namespace App\Models;

class AuthorModel extends AbstractModel
{
    private $data  = [];
    private $books = [];

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function setBooks(array $data)
    {
        $this->books = $data;
    }
}
