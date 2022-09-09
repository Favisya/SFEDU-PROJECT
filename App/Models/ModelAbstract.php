<?php

namespace App\Models;

abstract class ModelAbstract
{
    public function __toString()
    {
        return get_class();
    }
}