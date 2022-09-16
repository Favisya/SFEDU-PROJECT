<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class BookFormBlock extends Block
{
    public function setModel(AbstractModel $model)
    {
        $this->model["$model"] = $model;
    }
}
