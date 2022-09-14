<?php

namespace App\Models;

use App\Database\Database;

abstract class ModelAbstract
{
    public function __toString()
    {
        return get_class();
    }
}
