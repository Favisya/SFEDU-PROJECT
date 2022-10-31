<?php

namespace App\Models;

class UsersModel extends AbstractModel
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
}
