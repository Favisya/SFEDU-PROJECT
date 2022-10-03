<?php

namespace App\Models;

class LibrariesModel extends AbstractModel
{
    private $data = [];

    public function getList(): array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return 'libraries';
    }
}
