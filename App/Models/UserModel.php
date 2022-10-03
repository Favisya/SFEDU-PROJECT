<?php

namespace App\Models;

class UserModel extends AbstractModel
{
    private $data = [];

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getList(): ?array
    {
        return $this->data ?? null;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function getSurname(): ?string
    {
        return $this->data['surname'] ?? null;
    }

    public function __toString()
    {
        return 'user';
    }
}
