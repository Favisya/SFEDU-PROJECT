<?php

namespace App\Books\Models;

use App\Core\Models\AbstractModel;

class PublishersModel extends AbstractModel
{
    private $data = [];

    public function getList(): ?array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return 'publishers';
    }
}
