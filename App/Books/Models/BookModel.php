<?php

namespace App\Books\Models;

use App\Core\Models\AbstractModel;

class BookModel extends AbstractModel
{
    private $data = [];
    private $libs = [];

    public function getList(): ?array
    {
        return $this->data ?? null;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function getDate(): ?string
    {
        return $this->data['date'] ?? null;
    }

    public function getAuthor(): ?string
    {
        return $this->data['author'] ?? null;
    }

    public function getCountry(): ?string
    {
        return $this->data['country'] ?? null;
    }

    public function getLibs(): ?array
    {
        return $this->libs ?? null;
    }

    public function getPrice(): ?int
    {
        return $this->data['price'] ?? null;
    }

    public function getPublisher(): ?string
    {
        return $this->data['publisher'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
    }

    public function getAuthorId(): ?int
    {
        return $this->data['author_id'] ?? null;
    }

    public function getCount(): ?int
    {
        return $this->data['count'] ?? null;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setLibs(array $data)
    {
        $this->libs = $data;
    }

    public function __toString()
    {
        return 'book';
    }
}
