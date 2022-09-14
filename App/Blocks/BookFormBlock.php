<?php

namespace App\Blocks;

use App\Models\ModelAbstract;

class CreateBookBlock extends Block
{
    public function setModel(ModelAbstract $model)
    {
        $this->model["$model"] = $model;
    }
}
