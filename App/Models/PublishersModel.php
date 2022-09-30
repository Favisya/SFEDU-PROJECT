<?php

namespace App\Models;

class PublishersModel extends AbstractModel
{
    private $data = [];

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        $class = explode('\\', get_class());
        return $class = lcfirst(end($class));
    }
}
