<?php

namespace App\Models;

class CategoriesModel extends AbstractModel
{
    private $data = [];

    public function getList(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return 'categories';
    }
}
