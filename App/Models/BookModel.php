<?php

namespace App\Models;

class BookModel extends AbstractModel
{
    private $data = [];
    private $libs = [];

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function getLibs(): ?array
    {
        return $this->libs ?? null;
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
        $class = explode('\\', get_class());
        return $class = lcfirst(end($class));
    }
}
