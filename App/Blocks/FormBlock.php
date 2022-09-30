<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class FormBlock extends Block
{
    public function setModel(AbstractModel $model)
    {
        $this->model["$model"] = $model;
    }

    public function getOneModel(string $model)
    {
        return $this->model[$model];
    }
}
