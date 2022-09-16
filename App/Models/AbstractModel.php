<?php

namespace App\Models;

abstract class AbstractModel
{
    public function getData(): ?array
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