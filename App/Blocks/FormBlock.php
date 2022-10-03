<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class FormBlock extends Block
{
    public function setModel(AbstractModel $model)
    {
        $this->models["$model"] = $model;
    }

    public function getOneModel(string $model)
    {
        return $this->models[$model];
    }
}
