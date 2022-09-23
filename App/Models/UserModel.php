<?php

namespace App\Models;

class UserModel extends AbstractModel
{
    private $data = [];

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): ?array
    {
        return $this->data ?? null;
    }
}