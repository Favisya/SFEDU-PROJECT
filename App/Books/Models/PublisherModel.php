<?php

namespace App\Books\Models;

use App\Core\Models\AbstractModel;

class PublisherModel extends AbstractModel
{
    private $data = [];

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

    public function setData(array $data)
    {
        $this->data = $data;
    }
}
