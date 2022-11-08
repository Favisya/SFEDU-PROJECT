<?php

namespace App\Models;

use Laminas\Di\Di;

abstract class AbstractModel
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

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
