<?php

namespace App\Account\Models;

use App\Core\Models\AbstractModel;

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

    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }

    public function getId(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public function __toString()
    {
        return 'user';
    }
}
