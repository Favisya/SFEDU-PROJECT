<?php

namespace App\Core\Models;

abstract class AbstractModel
{
    public function getList(): ?array
    {
        return null;
    }

    public function setData(array $data)
    {
    }

    public function __toString()
    {
        return get_class();
    }
}
