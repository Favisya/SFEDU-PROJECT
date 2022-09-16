<?php

namespace App\Models;

class LibrariesModel extends AbstractModel
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
