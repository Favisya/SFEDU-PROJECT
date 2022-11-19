<?php

namespace App\Books\Models;

use App\Core\Models\AbstractModel;

class AuthorModel extends AbstractModel
{
    private $data  = [];
    private $books = [];

    public function getList(): ?array
    {
        return $this->data ?? null;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
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

    public function __toString()
    {
        return 'author';
    }
}
