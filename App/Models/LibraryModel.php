<?php

namespace App\Models;

class LibraryModel extends AbstractModel
{
    private $data  = [];
    private $books = [];

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function getAddress(): ?string
    {
        return $this->data['address'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
    }

    public function getBooks(): ?array
    {
        return $this->books ?? null;
    }

    public function getCount(): ?int
    {
        return $this->data['count'] ?? null;
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
