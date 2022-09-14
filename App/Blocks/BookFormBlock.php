<?php

namespace App\Blocks;

use App\Models\ModelAbstract;

class BookFormBlock extends Block
{
    public function setModel(ModelAbstract $model)
    {
        $this->model["$model"] = $model;
    }
}
